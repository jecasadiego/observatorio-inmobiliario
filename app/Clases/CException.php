<?php

namespace App\Clases;

use Exception;

class CException extends Exception {

    private $data;

    public function __construct($message, $code = 0, Exception $previous = null, $data = array('params'))
    {
        parent::__construct($message, $code, $previous);
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}