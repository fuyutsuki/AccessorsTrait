<?php

declare(strict_types=1);

namespace jp\mcbe\accessors\exception;

use Exception;

/**
 * Class DuplicateKeywordException
 * @package jp\mcbe\accessors\exception
 */
class DuplicateKeywordException extends Exception {

    public function __construct(string $propertyName) {
        parent::__construct("error: cannot access '{$propertyName}': duplicate keywords in the class property variable declaration");
    }

}