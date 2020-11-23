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
 * @property string $str
 */
class Foobar {

  use AccessorsTrait;

  private string $str = "default str";

  public function setStr(string $value) {
    $this->str = "[prefix] " . $value;
  }

}

$foobar = new Foobar();

$foobar->str = "example";// calls setter
var_dump($foobar->str);// if no getter, simply return the value of the property

/**
 * Output:
 * 
 * string(7) "[prefix] example"
 */
```