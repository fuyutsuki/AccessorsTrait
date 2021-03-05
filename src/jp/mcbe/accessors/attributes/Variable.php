<?php

declare(strict_types=1);

namespace jp\mcbe\accessors\attributes;

use Attribute;

/**
 * Class Variable
 * @package jp\mcbe\accessors
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Variable extends DeclareKeyword {

}