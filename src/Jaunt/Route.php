<?php

namespace Jaunt;

class Route
{
    protected $stack = [];
    protected $params = [];

    /**
     * Add a callback to the stack
     * @param $callback
     * @return void
     */
    public function addCallback($callback) {
        $this->stack[] = $callback;
    }

    /**
     * Add an array of callbacks to the stack
     * @param array $callbacks
     * @return void
     */
    public function addCallbacks($callbacks) {
        array_push($this->stack, $callbacks);
    }

    public function addParam($name, $value) {
        $this->params[$name] = $value;
    }

    public function getParams() {
        return $this->params;
    }

    public function getStack() {
        return $this->stack;
    }
}