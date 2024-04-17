<?php

namespace Jaunt;

class Router
{
    protected $current = null;
    protected $root = [];

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

    public function addRoute($method, $path, $callback): Router {
        $this->current =& $this->root;
        $parts = explode('/', $path);
        $parts_count = count($parts);
        $offset = ($parts_count > 1 && empty($parts[0])) ? 1 : 0;
        for ($i=$offset; $i < $parts_count; $i++) {
            if (!empty($parts[$i][0]) && $parts[$i][0] == ':') {
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
     * @param $method
     * @param $callback
     * @return void
     */
    protected function addCallback($method, $callback) {
        $this->current['{callbacks}'][] = [$method, $callback];
    }

    protected function addParam($param){
        if (!isset($this->current['param'])) {
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
     * Returns the route that matches the provided method and path
     * @param $method
     * @param $path
     * @return Route|null
     */
    public function route($method, $path): ?Route
    {
        $parts = array_reverse(explode('/', $path));
        if (count($parts) > 1 && empty($parts[0])) {
            array_pop($parts);
        }
        $route = new Route();
        $current = $this->root;
        while (($part = array_pop($parts)) !== null) {
            if (isset($current[$part])) {
                $current = $current[$part];
            } else if (isset($current['{param}']) || isset($current['{param_name}'])) {
                $route->addParam($current['{param_name}'], $part);
                $current = $current['{param}'];
            } else {
                return null;
            }
            if (isset($current["{callbacks}"])) {
                foreach ($current["{callbacks}"] as $callback) {
                    if ($callback[0] == 'USE' || $callback[0] == 'ALL' || strpos($callback[0], $method) !== false) {
                        $route->addCallback($callback);
                    }
                }
            }
       }
       if ($route->hasController()) {
           return $route;
       }
       return null;
    }
}