<?php

namespace StrongType;

use StrongType\Exceptions\CriticalTypeException;

class Float extends Number
{
    /**
     * @param $number
     * @throws CriticalTypeException
     */
    public function __construct($number)
    {
        $this->checkType($number);

        $this->number = $number;
    }
    /**
     * @return mixed
     */
    public function toNumber()
    {
        return $this->number;
    }
    /**
     * @param $type
     */
    public function setType($type)
    {
        $this->number = $type;
    }
    /**
     * @param $type
     * @throws CriticalTypeException
     */
    private function checkType($type)
    {
        if ($type !== null) {
            if (!is_float($type)) {
                throw new CriticalTypeException('Integer: Integer object must be constructed with an actual number. Some other type given');
            }
        }
    }
} 