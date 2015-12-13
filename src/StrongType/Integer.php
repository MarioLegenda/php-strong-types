<?php

namespace StrongType;

use StrongType\Exceptions\CriticalTypeException;

class Integer extends Number
{
    /**
     * @param null $number
     * @throws CriticalTypeException
     */
    public function __construct($number = null)
    {
        $this->checkType($number);

        $this->number = $number;
    }
    /**
     * @param $type
     */
    public function setType($type)
    {
        $this->number = $type;
    }
    /**
     * @void
     */
    public function roundDown()
    {
        $this->number = floor($this->number);
    }
    /**
     * @void
     */
    public function roundUp()
    {
        $this->number = ceil($this->number);
    }
    /**
     * @return int|null|Float
     */
    public function toNumber()
    {
        if (!is_int($this->number)) {
            return new Float($this->number);
        }

        return $this->number;
    }
    /**
     * @param $type
     * @throws CriticalTypeException
     */
    private function checkType($type)
    {
        if ($type !== null) {
            if (!is_int($type)) {
                throw new CriticalTypeException('Integer: Integer object must be constructed with an actual number. Some other type given');
            }
        }
    }
} 