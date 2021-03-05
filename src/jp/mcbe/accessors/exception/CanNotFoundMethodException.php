<?php

declare(strict_types=1);

namespace jp\mcbe\accessors\exception;

use Exception;

/**
 * Class CanNotFoundMethodException
 * @package jp\mcbe\accessors\exception
 */
class CanNotFoundMethodException extends Exception {

    public function __construct(object $obj, string $methodName) {
        parent::__construct("error: cannot access '{$methodName}': it is protected or private or no exist in " . $obj::class);
    }

}