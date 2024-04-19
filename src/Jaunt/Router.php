<?php

namespace Jaunt;

class Router
{
    protected $current = null;
    protected $root = [];

    public function __construct($tree = []) {
        $this->root = $tree;
    }

    public function all($path, $callback): Router {
        $this->addRoute('ALL', $path, $callback);
        return $this;
    }

    public function get($path, $callback): Router {
        $this->addRoute('GET', $path, $callback);
        return $this;
    }

    public function post($path, $callback): Router {
        $this->addRoute('POST',$path, $callback);
        return $this;
    }

    public function use($path, $callback): Router {
        $this->addRoute('USE', $path, $callback);
        return $this;
    }

    /**
     * Add a route to the router
     * @param string $method
     * @param string $path
     * @param callable $callback
     * @return $this
     */
    public function addRoute($method, $path, $callback): Router {
        $this->current =& $this->root;
        $parts = explode('/', $path);
        $parts_count = count($parts);
        $offset = ($parts_count > 1 && empty($parts[0])) ? 1 : 0;
        for ($i=$offset; $i < $parts_count; $i++) {
            if (!empty($parts[$i][0]) && $parts[$i][0] == '{') {
                $this->addParam($parts[$i]);
            } else {
                $this->addSegment($parts[$i]);
            }
        }
        $this->addCallback($method, $callback);
        return $this;
    }

    /**
     * Add a callback to the current node
     * @param string $method
     * @param callable $callback
     * @return void
     */
    protected function addCallback($method, $callback) {
        if ($method === 'USE') {
            $this->current['{middleware}'][] = $callback;
        } else {
            $this->current['{controllers}'][] = [$method,$callback];
        }
    }

    protected function addParam($param){
        if (!isset($this->current['{param}'])) {
            $this->current['{param}'] = [];
            $this->current['{param_name}'] = $param;
        }
        $this->current =& $this->current['{param}'];
    }

    protected function addSegment($segment) {
        if (!isset($this->current[$segment])) {
            $this->current[$segment] = [];
        }
        $this->current =& $this->current[$segment];
    }

    /**
     * Returns the assembled route tree
     * @return array|mixed
     */
    public function getRouteTree() {
        return $this->root;
    }

    /**
     * Returns the route that matches the provided method and path
     * @param string $method
     * @param string $path
     * @return array|null
     */
    public function route($method, $path) {
        $parts = array_reverse(explode('/', $path));
        if (count($parts) > 1 && empty(end($parts))) {
            array_pop($parts);
        }
        $route = [
            'stack' => [],
            'params' => []
        ];
        $current = $this->root;
        while (($part = array_pop($parts)) !== null) {
            if (isset($current[$part])) {
                $current = $current[$part];
            } else if (isset($current['{param}']) || isset($current['{param_name}'])) {
                $route['params'][substr($current['{param_name}'], 1, -1)] =  $part;
                $current = $current['{param}'];
            } else {
                return null;
            }
            if (isset($current["{middleware}"])) {
                array_push($route['stack'], $current["{middleware}"]);
            }
        }
        $matched = false;
        if (isset($current["{controllers}"])) {
            foreach ($current["{controllers}"] as $controller) {
                if ('ALL' === $controller[0] || strpos($controller[0], $method) !== false) {
                    $route['stack'][] = $controller[1];
                    $matched = true;
                }
            }
        }
        if ($matched) {
           return $route;
        }
        return null;
    }
}