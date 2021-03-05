<?php

declare(strict_types=1);

namespace jp\mcbe\accessors\exception;

use Exception;

/**
 * Class CanNotAccessPropertyException
 * @package jp\mcbe\accessors\exception
 */
class CanNotAccessPropertyException extends Exception {

    public function __construct(object $obj, string $propertyName) {
        parent::__construct("error: cannot access '{$propertyName}': it is protected or private in " . $obj::class);
    }

}