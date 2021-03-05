<?php

declare(strict_types=1);

namespace jp\mcbe\accessors\exception;

use Exception;

/**
 * Class CanNotBeReassignedException
 * @package jp\mcbe\accessors\exception
 */
class CanNotBeReassignedException extends Exception {

    public function __construct() {
        parent::__construct("error: Value cannot be reassigned");
    }

}