<?php

declare(strict_types=1);

namespace jp\mcbe\accessors;

use jp\mcbe\accessors\attributes\Accessor;
use jp\mcbe\accessors\attributes\DeclareKeyword;
use jp\mcbe\accessors\attributes\Getter;
use jp\mcbe\accessors\attributes\Setter;
use jp\mcbe\accessors\attributes\Value;
use jp\mcbe\accessors\attributes\Variable;
use jp\mcbe\accessors\exception\CanNotAccessPropertyException;
use jp\mcbe\accessors\exception\CanNotBeReassignedException;
use jp\mcbe\accessors\exception\CanNotFoundMethodException;
use jp\mcbe\accessors\exception\DuplicateKeywordException;
use ReflectionAttribute;
use ReflectionException;
use ReflectionProperty;
use function get_parent_class;
use function property_exists;

/**
 * Trait AccessorsTrait
 * @package jp\mcbe\accessors
 */
trait AccessorsTrait {

    /**
     * @param string $propertyName
     * @return mixed
     * @throws CanNotAccessPropertyException
     * @throws CanNotFoundMethodException
     * @throws DuplicateKeywordException
     * @throws ReflectionException
     */
    public function __get(string $propertyName): mixed {
        $reflection = new ReflectionProperty($this, $propertyName);
        $attrs = $reflection->getAttributes(Accessor::class, ReflectionAttribute::IS_INSTANCEOF);
        $attrsName = array_flip(array_map(fn($attr) => $attr->getName(), $attrs));

        if (isset($attrsName[Getter::class])) {
            $attr = $reflection->getAttributes(Getter::class)[0];
            /** @var Getter $getter */
            $getter = $attr->newInstance();
            $methodName = $getter->methodName;
            if (method_exists($this, $methodName)) {
                return $this->$methodName();
            }else {
                throw new CanNotFoundMethodException($this, $methodName);
            }
        }

        if (isset($attrsName[Variable::class], $attrsName[Value::class])) {
            throw new DuplicateKeywordException($propertyName);
        }

        if (property_exists($this, $propertyName)) {
            if (isset($attrsName[Variable::class]) || isset($attrsName[Value::class])) {
                return $this->$propertyName;
            }
        }

        $parent = get_parent_class();
        if ($parent !== false && method_exists($parent, "__get")) {
            return $parent::__get($propertyName);
        }
        throw new CanNotAccessPropertyException($this, $propertyName);
    }

    /**
     * @param string $propertyName
     * @param mixed $value
     * @throws CanNotAccessPropertyException
     * @throws CanNotBeReassignedException
     * @throws CanNotFoundMethodException
     * @throws DuplicateKeywordException
     * @throws ReflectionException
     */
    public function __set(string $propertyName, mixed $value): void {
        $reflection = new ReflectionProperty($this, $propertyName);
        $attrs = $reflection->getAttributes(Accessor::class, ReflectionAttribute::IS_INSTANCEOF);
        $attrsName = array_flip(array_map(fn($attr) => $attr->getName(), $attrs));

        if (!isset($attrsName[Value::class]) && isset($attrsName[Setter::class])) {
            $attr = $reflection->getAttributes(Setter::class)[0];
            /** @var Setter $setter */
            $setter = $attr->newInstance();
            $methodName = $setter->methodName;
            if (method_exists($this, $methodName)) {
                $this->$methodName($value, ...$setter->args);
                return;
            }else {
                throw new CanNotFoundMethodException($this, $methodName);
            }
        }

        if (isset($attrsName[Variable::class], $attrsName[Value::class])) {
            throw new DuplicateKeywordException($propertyName);
        }

        if (property_exists($this, $propertyName)) {
            if (isset($attrsName[Variable::class]) || isset($attrsName[Value::class])) {
                $attr = $reflection->getAttributes(DeclareKeyword::class, ReflectionAttribute::IS_INSTANCEOF)[0];
                /** @var DeclareKeyword $var */
                $var = $attr->newInstance();
                if ($var instanceof Variable) {
                    if (!$var->isPrivate()) {
                        $this->$propertyName = $value;
                        return;
                    }
                }else {
                    throw new CanNotBeReassignedException;
                }
            }
        }

        $parent = get_parent_class();
        if ($parent !== false && method_exists($parent, "__set")) {
            $parent::__set($propertyName, $value);
        }
        throw new CanNotAccessPropertyException($this, $propertyName);
    }

}