<?php

use Penobit\ArrayQuery\ArrayQuery;
use Penobit\ArrayQuery\QueryEngine;

if (!function_exists('convert_to_array')) {
    function convert_to_array($data) {
        if (!is_array($data) && !$data instanceof QueryEngine) {
            return [$data];
        }

        $new_data = [];
        foreach ($data as $key => $map) {
            if ($map instanceof QueryEngine) {
                $new_data[$key] = convert_to_array($map);
            } else {
                $new_data[$key] = $map;
            }
        }

        return $new_data;
    }
}

if (!function_exists('arrayq')) {
    /**
     * @param $data
     *
     * @return \Penobit\ArrayQuery\QueryEngine
     */
    function arrayq($data = []) {
        if (!is_array($data)) {
            $data = [];
        }

        $instance = ArrayQuery::getInstance();

        return $instance->collect($data);
    }
}

if (!function_exists('linq')) {
    /**
     * initiate linq with given data
     *
     * @param array|object|string $data
     * @return Penobit\Linq\Linq
     */
    function linq($data):Penobit\Linq\Linq {
        // if (!is_string($data)) throw new \Penobit\ArrayQuery\Exceptions\InvalidJsonException();

        $linq = new Penobit\Linq\Linq();

        // if (is_array($data) || is_object($data)) {
        //     $data = json_encode($data);
        // }

        $data = $linq->parseData($data);

        return $linq->collect($data);
    }
}
