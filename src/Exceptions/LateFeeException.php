<?php

namespace src\Exceptions;

use Exception;

class LateFeeException extends Exception {
    public function __construct($message = "Member cannot borrow books due to outstanding late fees.", $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}