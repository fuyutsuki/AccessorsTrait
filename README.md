## AccessorsTrait

A micro composer library that provides kotlin-like getter/setter

### Installation

#### Composer:

```bash
composer require fuyutsuki/accessors-trait
```

#### [Virion](https://poggit.github.io/support/virion.html):

Edit the .poggit.yml of the plugin you want to use this library as follows.

```yml
--- # Poggit-CI Manifest. Open the CI at https://poggit.pmmp.io/ci/author/YourProject
branches:
  - master
projects:
  YourProject:
    path: ""
    icon: ""
    libs:
      - src: fuyutsuki/AccessorsTrait/accessors-trait
        version: 1.0.0
...
```

### Usage

```php
<?php

declare(strict_types=1);

namespace hoge\huga;

use jp\mcbe\accessors\AccessorsTrait;
use jp\mcbe\accessors\attributes\Getter;
use jp\mcbe\accessors\attributes\Setter;
use jp\mcbe\accessors\attributes\Value;
use jp\mcbe\accessors\attributes\Variable;

/**
 * Class Foobar
 * @package hoge\huga
 * 
 * @property int $varInt
 * @property string $varStr
 * @property-read string $valStr
 */
class Foobar {

  use AccessorsTrait;
  
  public function __construct(
    #[Variable]
    private int $varInt = 0,// property MUST be private
  
    #[Variable]
    #[Setter("setVarStr")] // custom setter
    private string $varStr = "private var",
    
    #[Value]
    #[Getter("getPrivateVal")] // custom getter
    private string $valStr = "private val",
  ) {
  }
  
  public function setVarStr(string $value) {
    $this->varStr = $value;
  }
  
  public function getPrivateVal(): string {
    return strtoupper($this->valStr);
  }

}

$foobar = new Foobar();

$foobar->varInt = 1;
var_dump($foobar->varInt);// 1

$foobar->varStr = "var example";// calls Foobar::setVarStr()
var_dump($foobar->varStr);// if no getter, simply return the value of the property

// $foobar->valStr = "val example";
// CanNotAccessPropertyException
var_dump($foobar->valStr);// calls Foobar::getPrivateVal()

/**
 * Output:
 * 
 * string(11) "var example"
 * string(11) "PRIVATE VAL"
 */
```