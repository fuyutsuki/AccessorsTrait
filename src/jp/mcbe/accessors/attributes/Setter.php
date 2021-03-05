<?php

declare(strict_types=1);

namespace jp\mcbe\accessors\attributes;

use Attribute;
use jp\mcbe\accessors\AccessorsTrait;

/**
 * Class Setter
 * @package jp\mcbe\accessors
 *
 * @property-read string $methodName
 * @property-read array $args
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Setter extends Accessor {

    use AccessorsTrait;

    #[Value]
    private array $args;

    public function __construct(
        #[Value]
        private string $methodName,
        mixed ...$args,
    ) {
        $this->args = $args;
    }

}