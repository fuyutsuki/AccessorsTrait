<?php

declare(strict_types=1);

namespace jp\mcbe\accessors;

use function get_parent_class;
use function method_exists;
use function property_exists;
use function ucfirst;

/**
 * Trait AccessorsTrait
 * @package jp\mcbe\accessors
 */
trait AccessorsTrait {

    private static string $_getter = "get";
    private static string $_is = "is";
    private static string $_setter = "set";

    /**
     * @param string $propertyName
     * @return mixed
     * @throws PropertyNotFoundException
     */
    public function __get(string $propertyName) {
        $getterFuncName = self::$_getter . ucfirst($propertyName);
        if (method_exists($this, $getterFuncName)) {// get{PropertyName}
            return $this->$getterFuncName();
        }
        $isFuncName = self::$_is . ucfirst($propertyName);
        if (method_exists($this, $isFuncName)) {// is{PropertyName}
            return $this->$isFuncName();
        }
        if (property_exists($this, $propertyName)) {
            return $this->$propertyName;
        }
        $parent = get_parent_class();
        if ($parent !== false) {
            return $parent::__get($propertyName);
        }
        throw new PropertyNotFoundException($this, $propertyName);
    }

    /**
     * @param string $propertyName
     * @param mixed $value
     * @throws PropertyNotFoundException
     */
    public function __set(string $propertyName, $value) {
        $setterFuncName = self::$_setter . ucfirst($propertyName);
        if (method_exists($this, $setterFuncName)) {// set{PropertyName}
            $this->$setterFuncName($value);
            return;
        }
        if (property_exists($this, $propertyName)) {
            $this->$propertyName = $value;
            return;
        }
        $parent = get_parent_class();
        if ($parent !== false) {
            $parent::__set($propertyName);
            return;
        }
        throw new PropertyNotFoundException($this, $propertyName);
    }

}