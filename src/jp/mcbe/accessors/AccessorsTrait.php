<?php

declare(strict_types=1);

namespace jp\mcbe\accessors;

use function method_exists;
use function property_exists;
use function ucfirst;

/**
 * Trait AccessorsTrait
 * @package jp\mcbe\accessors
 */
trait AccessorsTrait {

    private static string $getter = "get";
    private static string $is = "is";
    private static string $setter = "set";

    /**
     * @param string $propertyName
     * @return mixed
     * @throws PropertyNotFoundException
     */
    public function __get(string $propertyName) {
        $getterFuncName = self::$getter . ucfirst($propertyName);
        if (method_exists($this, $getterFuncName)) {// getter
            return $this->$getterFuncName();
        }
        $isFuncName = self::$is . ucfirst($propertyName);
        if (method_exists($this, $isFuncName)) {// is
            return $this->$isFuncName();
        }
        if (property_exists($this, $propertyName)) {
            return $this->$propertyName;
        }
        if (get_parent_class($this)) {
            return parent::__get($propertyName);
        }
        throw new PropertyNotFoundException($this, $propertyName);
    }

    /**
     * @param string $propertyName
     * @param mixed $value
     * @throws PropertyNotFoundException
     */
    public function __set(string $propertyName, $value) {
        $setterFuncName = self::$setter . ucfirst($propertyName);
        if (method_exists($this, $setterFuncName)) {// setter
            $this->$setterFuncName($value);
            return;
        }
        if (property_exists($this, $propertyName)) {
            $this->$propertyName = $value;
            return;
        }
        if (get_parent_class($this)) {
            parent::__set($propertyName);
            return;
        }
        throw new PropertyNotFoundException($this, $propertyName);
    }

}