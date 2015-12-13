<?php

namespace StrongType;

use StrongType\Exceptions\CriticalTypeException;

class Boolean extends Type
{
    /**
     * @var bool $innerBool
     */
    private $innerBool;

    /**
     * @param $boolean
     * @throws CriticalTypeException
     */
    public function __construct($boolean)
    {
        $this->typeCheck($boolean);
        $this->innerBool = $boolean;
    }

    /**
     * @param $type
     * @throws CriticalTypeException
     */
    public function setType($type)
    {
        $this->typeCheck($type);

        $this->innerBool = $type;
    }

    /**
     * @return bool
     */
    public function toBoolean()
    {
        return $this->innerBool;
    }

    /**
     * @param Boolean $boolean
     * @return bool
     */
    public function equals(Boolean $boolean)
    {
        if ($boolean->toBoolean() === $this->innerBool) {
            return true;
        }

        return false;
    }

    /**
     * @param Boolean $boolean
     * @return bool
     */
    public static function isTrue(Boolean $boolean)
    {
        return $boolean->toBoolean() === true;
    }

    /**
     * @param Boolean $boolean
     * @return bool
     */
    public static function isFalse(Boolean $boolean)
    {
        return $boolean->toBoolean() === false;
    }

    /**
     * @param $boolean
     * @throws CriticalTypeException
     */
    private function typeCheck($boolean)
    {
        if (!is_bool($boolean)) {
            throw new CriticalTypeException("Bool: Bool() constructor called with an argument that is not a boolean. Makes sense for a Bool to receive a boolean, don't you think?");
        }
    }
} 