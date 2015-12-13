<?php

namespace StrongType;

abstract class Number extends Type
{
    /**
     * @var null
     */
    protected $number = null;

    /**
     * @return mixed
     */
    abstract public function toNumber();
    /**
     * @param Number $number
     * @return $this
     */
    public function add(Number $number)
    {
        $this->number = $this->number + $number->toNumber();

        return $this;
    }
    /**
     * @param Number $number
     * @return $this
     */
    public function substract(Number $number)
    {
        $this->number = $this->number - $number->toNumber();

        return $this;
    }
    /**
     * @param Number $number
     * @return $this
     */
    public function divide(Number $number)
    {
        $this->number = $this->number / $number->toNumber();

        return $this;
    }
    /**
     * @param Number $number
     * @return $this
     */
    public function multiply(Number $number)
    {
        $this->number = $this->number * $number->toNumber();

        return $this;
    }
} 