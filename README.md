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
        version: 0.1.0
...
```