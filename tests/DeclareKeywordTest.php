<?php

declare(strict_types=1);

use jp\mcbe\accessors\AccessorsTrait;
use jp\mcbe\accessors\attributes\Value;
use jp\mcbe\accessors\attributes\Variable;
use jp\mcbe\accessors\exception\DuplicateKeywordException;
use PHPUnit\Framework\TestCase;

class DeclareKeywordTest extends TestCase {

    public function testDuplicateDeclareKeyword() {
        $testClass = new class {
            use AccessorsTrait;

            #[Variable]
            #[Value]
            private string $name = "steve";

        };
        $this->expectException(DuplicateKeywordException::class);
        print($testClass->name);
    }

}