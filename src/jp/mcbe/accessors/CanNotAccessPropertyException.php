<?php

declare(strict_types=1);

namespace jp\mcbe\accessors;

use Exception;
use function get_class;

/**
 * Class CanNotAccessPropertyException
 * @package jp\mcbe\accessors
 */
class CanNotAccessPropertyException extends Exception {

    public function __construct(object $class, string $propertyName) {
        parent::__construct("error: cannot access '{$propertyName}': it is protected or private in " . get_class($class));
    }

}