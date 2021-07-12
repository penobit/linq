<?php

namespace Penobit\ArrayQuery;

class ArrayQuery extends QueryEngine {
    /**
     * @var null|QueryEngine
     */
    protected static $instance = null;

    public function __construct($data = []) {
        if (\is_array($data)) {
            $this->collect($data);
        } else {
            parent::__construct($data);
        }
    }

    public static function getInstance() {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function readPath($file) {
        return '{}';
    }

    public function parseData($data) {
        return $this->collect([]);
    }
}