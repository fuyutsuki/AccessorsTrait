<?php

declare(strict_types=1);

use jp\mcbe\accessors\AccessorsTrait;
use jp\mcbe\accessors\attributes\Getter;
use jp\mcbe\accessors\attributes\Setter;
use jp\mcbe\accessors\attributes\Value;
use jp\mcbe\accessors\attributes\Variable;
use jp\mcbe\accessors\exception\CanNotBeReassignedException;
use jp\mcbe\accessors\exception\CanNotFoundMethodException;
use PHPUnit\Framework\TestCase;

/**
 * Class SetterTest
 */
class SetterTest extends TestCase {

    public function testVariableSetter() {
        $testClass = new class {
            use AccessorsTrait;

            #[Variable]
            #[Setter("setName")]
            private string $name = "Steve";

            public function setName(string $value) {
                $this->name = strtoupper($value);
            }
        };
        $testClass->name = "Steve";
        $this->assertSame("STEVE", $testClass->name);
    }

    public function testValueSetter() {
        $testClass = new class {
            use AccessorsTrait;

            #[Value]
            #[Setter("setName")]
            private string $name = "Alex";

            public function setName(string $value) {
                $this->name = $value;
            }
        };
        $this->expectException(CanNotBeReassignedException::class);
        $testClass->name = "ALEX";
    }

    public function testGetterNotFound() {
        $testClass = new class {
            use AccessorsTrait;

            #[Variable]
            #[Setter("nonExists")]
            private string $name = "Alex";

            public function getName(): string {
                return strtoupper($this->name);
            }
        };
        $this->expectException(CanNotFoundMethodException::class);
        $testClass->name = "Alex";
    }

}