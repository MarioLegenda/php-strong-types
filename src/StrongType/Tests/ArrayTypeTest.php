<?php

namespace StrongType\Tests;

use StrongType\ArrayType;

class ArrayTypeTest extends \PHPUnit_Framework_TestCase
{
    public function testImplode()
    {
        $glue = ',';
        $array = array('martina', 'zeljka', 'kristina', 'morena');

        $type = new ArrayType($array);

        $imploded = $type->implode($glue, array('zrinka'), 'budala', 6);
    }

    public function testKeyExists()
    {
        $multiArray = array(
            'name' => 'Mario',
            'lastname' => 'Škrlec',
            'birth' => array(
                'day' => 18,
                'month' => 06,
                'year' => 1986,
            ),
        );

        $type = new ArrayType($multiArray);

        $value = $type->keyExists('year');
    }

    public function testDifferenceInValues()
    {
        $arrayOne = array('konj', 'budala', 'idiot', 'kreten');
        $arrayTwo = array('idiot', 'šporki', 'redikul', 'konj');
    }
}