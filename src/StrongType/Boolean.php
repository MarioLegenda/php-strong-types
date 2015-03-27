<?php

namespace StrongType;

use StrongType\Exceptions\CriticalTypeException;

class Boolean extends Type
{
    private $innerBool;

    public function __construct($boolean) {
        $this->innerBool = $boolean;
    }

    public function setType($type) {
        $this->typeCheck($type);

        $this->innerBool = $type;
    }

    public function toBoolean() {
        return $this->innerBool;
    }

    public function equals(Boolean $bool) {
        if($bool->toBoolean() === $this->innerBool) {
            return true;
        }

        return false;
    }

    public static function isTrue(Boolean $boolean) {
        return $boolean->toBoolean() === true;
    }

    public static function isFalse(Boolean $boolean) {
        return $boolean->toBoolean() === false;
    }

    private function typeCheck($bool) {
        if($bool !== null) {
            if( ! is_bool($bool)) {
                throw new CriticalTypeException("Bool: Bool() constructor called with an argument that is not a boolean. Makes sense for a Bool to receive a boolean, don't you think?");
            }

            if(empty($bool)) {
                throw new CriticalTypeException("Bool: Bool() construct argument has to be a boolean. Don't pass '' ");
            }
        }
    }
} 