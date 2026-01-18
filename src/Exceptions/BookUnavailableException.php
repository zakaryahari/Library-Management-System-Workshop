<?php

namespace src\Exceptions;

use Exception;

class BookUnavailableException extends Exception {
    public function __construct($message = "This book is currently out of stock or already borrowed.", $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}