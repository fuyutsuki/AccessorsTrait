<?php

declare(strict_types=1);

use jp\mcbe\accessors\AccessorsTrait;
use jp\mcbe\accessors\attributes\Getter;
use jp\mcbe\accessors\attributes\Value;
use jp\mcbe\accessors\attributes\Variable;
use jp\mcbe\accessors\exception\CanNotFoundMethodException;
use PHPUnit\Framework\TestCase;

/**
 * Class GetterTest
 */
class GetterTest extends TestCase {

    public function testVariableGetter() {
        $testClass = new class {
            use AccessorsTrait;

            #[Variable]
            #[Getter("getName")]
            private string $name = "Steve";

            public function getName(): string {
                return strtolower($this->name);
            }
        };
        $this->assertSame("steve", $testClass->name);
    }

    public function testValueGetter() {
        $testClass = new class {
            use AccessorsTrait;

            #[Value]
            #[Getter("getName")]
            private string $name = "Alex";

            public function getName(): string {
                return strtoupper($this->name);
            }
        };
        $this->assertSame("ALEX", $testClass->name);
    }

    public function testGetterNotFound() {
        $testClass = new class {
            use AccessorsTrait;

            #[Value]
            #[Getter("nonExists")]
            private string $name = "Alex";

            public function getName(): string {
                return strtoupper($this->name);
            }
        };
        $this->expectException(CanNotFoundMethodException::class);
        print($testClass->name);
    }

}