<?php

namespace StrongType;

use StrongType\Exceptions\CriticalTypeException;

class ArrayType extends Type implements \IteratorAggregate, \Countable, \ArrayAccess
{
    /**
     * TODO:
     *
     * - array difference in values
     * - array difference in keys
     *
     */

    const DIFFERENCES = 1;
    const SIMILARITES = 2;

    private $constans = array(1, 2);

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
     * @param mixed $searchValue
     * @param null|mixed $key
     * @return bool|null
     */
    public function inArray($searchValue, $key = null)
    {
        $array = $this->arrayType;

        if ($key !== null) {
            if (!array_key_exists($key, $this->arrayType)) {
                return null;
            }

            $array = $this->arrayType[$key];
        }

        return in_array($searchValue, $array);
    }
    /**
     * @param string $glue
     *
     * @return string
     *
     * @throws CriticalTypeException
     */
    public function implode($glue)
    {
        $args = func_get_args();

        unset($args[0]);

        if (!is_string($glue)) {
            throw new CriticalTypeException('ArrayType::implode() first argument has to be a string');
        }

        $inital = implode($glue, $this->arrayType);

        foreach ($args as $arg) {
            if (is_string($arg)) {
                $inital .= $glue.$arg;
            }

            if (is_array($arg)) {
                $imploded = implode($glue, $arg);

                $inital .= $glue.$imploded;
            }

            if (is_numeric($arg)) {
                $toString = (string) $arg;

                $inital .= $glue.$toString;
            }
        }

        return $inital;
    }
    /**
     * @param string $key
     * @return bool
     */
    public function keyExists($key, $returnValue = false)
    {
        $constant = ($returnValue === true) ? \RecursiveIteratorIterator::CHILD_FIRST : \RecursiveIteratorIterator::LEAVES_ONLY;

        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($this->arrayType), $constant);

        while ($iterator->valid()) {
            $itKey = $iterator->key();

            if ($itKey === $key) {
                return ($returnValue === true) ? $iterator->current() : true;
            }

            $iterator->next();
        }

        return true;
    }
    /**
     * @param array $args
     */
    public function differenceInValues(array $arrayOne, array $arrayTwo)
    {
        $iteratorOne = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($arrayTwo), $constant);

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