<?php

namespace StrongType;

use StrongType\Exceptions\CriticalTypeException;

class ArrayType extends Type implements \IteratorAggregate, \Countable, \ArrayAccess
{
    /**
     * @var array $arrayType
     */
    private $arrayType;

    /**
     * @param array $arrayType
     * @throws CriticalTypeException
     */
    public function __construct(array $arrayType)
    {
        $this->typeCheck($arrayType);

        $this->arrayType = $arrayType;
    }

    /**
     * @param mixed $arrayType
     * @throws CriticalTypeException
     */
    public function setType($arrayType)
    {
        $this->typeCheck($arrayType);

        $this->arrayType = $arrayType;
    }
    /**
     * @return int
     */
    public function count()
    {
        return count($this->arrayType);
    }
    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->arrayType);
    }
    /**
     * @return array
     */
    public function toArray()
    {
        return $this->arrayType;
    }
    /**
     * @param $key
     * @return bool
     */
    public function keyExists($key)
    {
        return array_key_exists($key, $this->arrayType);
    }

    /**
     * @return bool
     */
    public function isArray()
    {

    }
    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if (!$this->offsetExists($offset)) {
            $this->arrayType[$offset] = $value;
        }
    }
    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->arrayType);
    }
    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->arrayType[$offset]);
    }
    /**
     * @param mixed $offset
     * @return null
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            return null;
        }

        return $this->arrayType[$offset];
    }
    /**
     * @param mixed $arrayType
     * @throws CriticalTypeException
     */
    private function typeCheck($arrayType)
    {
        if ($arrayType !== null) {
            if (!is_array($arrayType)) {
                throw new CriticalTypeException("ArrayType: ArrayType() constructor called with an argument that is not a array");
            }

            if (empty($arrayType)) {
                throw new CriticalTypeException("String: String() construct argument has to be a non-empty array. Don't pass array() ");
            }
        }
    }
} 