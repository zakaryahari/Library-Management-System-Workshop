<?php

namespace src\Exceptions;

use Exception;

class MemberLimitExceededException extends Exception {
    public function __construct($message = "Member has reached the maximum number of borrowed books.", $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}