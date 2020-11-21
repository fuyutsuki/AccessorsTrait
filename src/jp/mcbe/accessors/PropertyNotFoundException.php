<?php

declare(strict_types=1);

namespace jp\mcbe\accessors;

use Exception;

/**
 * Class PropertyNotFoundException
 * @package jp\mcbe\accessors
 */
class PropertyNotFoundException extends Exception {

    public function __construct(object $class, string $propertyName) {
        parent::__construct("class: " . get_class($class) . "->{$propertyName}", 800);
    }

}