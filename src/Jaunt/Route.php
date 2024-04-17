<?php

namespace Jaunt;

class Route
{
    protected $stack;
    protected $params = [];
    protected $hasController = false;

    /**
     * Add a callback to the stack
     * @param array $callback [{method},{callback}]
     * @return void
     */
    public function addCallback($callback) {
        if ($callback[0] != 'USE') {
            $this->hasController = true;
        }
        $this->stack[] = $callback;
    }

    public function addParam($name, $value) {
        $this->params[$name] = $value;
    }

    public function hasController() {
        return $this->hasController;
    }

    public function getParams() {
        return $this->params;
    }

    public function getStack() {
        return $this->stack;
    }
}