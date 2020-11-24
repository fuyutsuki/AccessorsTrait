## AccessorsTrait

A micro composer library that provides kotlin-like getter/setter

### Installation

#### Composer:

```bash
composer require fuyutsuki/accessors-trait
```

#### Virion:

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
      - src: fuyutsuki/accessors-trait/accessors-trait
        version: 0.2.0
...
```

### Usage

```php
<?php

declare(strict_types=1);

namespace hoge\huga;

use jp\mcbe\accessors\AccessorsTrait;

/**
 * Class Foobar
 * @package hoge\huga
 * 
 * @property string $varStr
 * @property-read string $_valStr
 */
class Foobar {

  use AccessorsTrait;

  private string $varStr = "private var";
  private string $_valStr = "private val";

}

$foobar = new Foobar();

$foobar->varStr = "var example";// calls var setter
var_dump($foobar->varStr);// if no getter, simply return the value of the property

// $foobar->_valStr = "val example";
// CanNotAccessPropertyException
var_dump($foobar->_valStr);

/**
 * Output:
 * 
 * string(11) "var example"
 * string(11) "val example"
 */
```