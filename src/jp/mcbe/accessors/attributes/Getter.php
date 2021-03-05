<?php

declare(strict_types=1);

namespace jp\mcbe\accessors\attributes;

use Attribute;
use jp\mcbe\accessors\AccessorsTrait;

/**
 * Class Getter
 * @package jp\mcbe\accessors
 *
 * @property-read string $methodName
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Getter extends Accessor {

    use AccessorsTrait;

    public function __construct(
        #[Value]
        private string $methodName,
    ) {
    }
}