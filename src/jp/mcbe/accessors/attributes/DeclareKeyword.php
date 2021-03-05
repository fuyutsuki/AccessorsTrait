<?php

declare(strict_types=1);

namespace jp\mcbe\accessors\attributes;

/**
 * Class DeclareKeyword
 * @package jp\mcbe\accessors
 */
abstract class DeclareKeyword extends Accessor {

    public function __construct(
        private bool $isPrivate = false,
    ) {
    }

    public function isPrivate(): bool {
        return $this->isPrivate;
    }

}