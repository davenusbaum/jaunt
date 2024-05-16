<?php

namespace Jaunt;

class Router
{
    const CONTROLLERS = '>';
    const MIDDLEWARE = '<';
    const PARAM_NEXT = '}';
    const PARAM_NAME = '{';
    protected $current = null;
    protected $root = [];

    /**
     * Create a router
     * @param $tree Optional predefined route tree
     */
    public function __construct($tree = []) {
        $this->root = $tree;
    }

    /**
     * Add a route that is used for all HTTP methods
     * @param $path
     * @param $callback
     * @return $this
     */
    public function all($path, $callback): Router {
        $this->add('ALL', $path, $callback);
        return $this;
    }

    /**
     * Add a route to handle a DELETE request
     * @param $path
     * @param $callback
     * @return $this
     */
    public function delete($path, $callback): Router {
        $this->add('DELETE',$path, $callback);
        return $this;
    }

    /**
     * Add a route to handle a HTTP GET
     * @param $path
     * @param $callback
     * @return $this
     */
    public function get($path, $callback): Router {
        $this->add('GET', $path, $callback);
        return $this;
    }

    /**
     * Add a route to handle a POST request
     * @param $path
     * @param $callback
     * @return $this
     */
    public function post($path, $callback): Router {
        $this->add('POST',$path, $callback);
        return $this;
    }

    /**
     * Add a route to handle a PUT request
     * @param $path
     * @param $callback
     * @return $this
     */
    public function put($path, $callback): Router {
        $this->add('PUT',$path, $callback);
        return $this;
    }

    /**
     * Add middleware to be used for a specific route
     * @param $path
     * @param $callback
     * @return $this
     */
    public function use($path, $callback): Router {
        $this->add('USE', $path, $callback);
        return $this;
    }

    /**
     * Add a route to the router
     * @param string $method
     * @param string $path
     * @param callable $callback
     * @return $this
     */
    public function add($method, $path, $callback): Router {
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
     * @param string $method
     * @param callable|callable[] $callback
     * @return void
     */
    protected function addCallback($method, $callback) {
        if ($method === 'USE') {
            $this->current[self::MIDDLEWARE][] = $callback;
        } else {
            $this->current[self::CONTROLLERS][] = [$method,$callback];
        }
    }

    /**
     * Add a dynamic parameter to the current route
     * @param $param
     * @return void
     */
    protected function addParam($param){
        if (!isset($this->current[self::PARAM_NEXT])) {
            $this->current[self::PARAM_NEXT] = [];
            $this->current[self::PARAM_NAME] = $param;
        }
        $this->current =& $this->current[self::PARAM_NEXT];
    }

    /**
     * Add a static segment to the current route
     * @param $segment
     * @return void
     */
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
    public function find($method, $path) {
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
            } else if (isset($current[self::PARAM_NEXT]) || isset($current[self::PARAM_NAME])) {
                $route['params'][substr($current[self::PARAM_NAME], 1)] =  $part;
                $current = $current[self::PARAM_NEXT];
            } else {
                return null;
            }
            if (isset($current[self::MIDDLEWARE])) {
                foreach ($current[self::MIDDLEWARE] as $middleware) {
                    $route['stack'][] = $middleware;
                }
            }
        }
        $matched = false;
        if (isset($current[self::CONTROLLERS])) {
            foreach ($current[self::CONTROLLERS] as $controller) {
                if ('ALL' === $controller[0] || stripos($controller[0], strtoupper($method)) !== FALSE) {
                    if (!in_array($controller[1], $route->stack)) {
                        $route->stack[] = $controller[1];
                    }
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