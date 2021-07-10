<?php

namespace Penobit\Linq;

use Penobit\ArrayQuery\Exceptions\InvalidJsonException;
use Penobit\ArrayQuery\Exceptions\FileNotFoundException;
use Penobit\ArrayQuery\QueryEngine;

class Linq extends QueryEngine
{

    /**
     * Parse valid JSON data to an Array
     *
     * @param string $data
     * @return array|mixed
     * @throws InvalidJsonException
     */
    public function parseData($data)
    {
        if (is_null($data)) return [];
        if(is_array($data) || is_object($data)){
            $data = json_encode($data, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
        }

        $data = json_decode($data, true);
        if (json_last_error() != JSON_ERROR_NONE) throw new InvalidJsonException();

        return $data;
    }

    /**
     * Parse data from give file or URL
     *
     * @param string $jsonFile
     * @return array|mixed
     * @throws FileNotFoundException
     * @throws InvalidJsonException
     */
    public function readPath($jsonFile)
    {
        if (is_null($jsonFile)) {
            throw new FileNotFoundException();
        }

        $rawData = null;

        if (filter_var($jsonFile, FILTER_VALIDATE_URL)) {
            $rawData = file_get_contents($jsonFile);
        }

        if (file_exists($jsonFile)) {
            $path = pathinfo($jsonFile);
            $extension = isset($path['extension']) ? $path['extension'] : null;

            if ($extension != 'json') {
                throw new InvalidJsonException();
            }

            $rawData = file_get_contents($jsonFile);
        }

        if (is_null($rawData)) throw new FileNotFoundException();

        $data = json_decode($rawData, true);

        if (json_last_error() !== JSON_ERROR_NONE) throw new InvalidJsonException();

        return $data;
    }
}
