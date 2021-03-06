<?php

use Penobit\ArrayQuery\ArrayQuery;
use Penobit\ArrayQuery\QueryEngine;

if (!function_exists('convert_to_array')) {
    function convert_to_array($data) {
        if (!is_array($data) && !$data instanceof QueryEngine) {
            return [$data];
        }

        if(is_array($data)) {
            $new_data = [];
            foreach ($data as $key => $map) {
                if ($map instanceof QueryEngine) {
                    $new_data[$key] = convert_to_array($map);
                } else {
                    $new_data[$key] = $map;
                }
            }
        }elseif(is_object($data)){
            $new_data = (object) [];
            foreach ($data as $key => $map) {
                if ($map instanceof QueryEngine) {
                    $new_data->$key = convert_to_array($map);
                } else {
                    $new_data->$key = $map;
                }
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