<?php

namespace Penobit\ArrayQuery\Exceptions;

class NullValueException extends \Exception
{
    public function __construct($message = "Null value exception", $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
