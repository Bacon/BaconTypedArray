<?php
/**
 * BaconTypedArray
 *
 * @link      http://github.com/Bacon/BaconTypedArray For the canonical source repository
 * @copyright 2012 Ben 'DASPRiD' Scholzen
 * @license   http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */

namespace BaconTypedArray;

use PHPUnit_Framework_TestCase as TestCase;

class Int32ArrayTest extends TestCase
{
    public function testCount()
    {
        $array = new Int32Array(array(1, 2, 3));
        $this->assertEquals(3, count($array));
    }

    public function testToString()
    {
        $array  = new Int32Array(array(1, 2, 3));
        $binary = pack('H*', '010000000200000003000000');

        $this->assertEquals($binary, $array->toString());
        $this->assertEquals($array->toString(), (string) $array);
    }

    public function testFromString()
    {
        $binary = pack('H*', '010000000200000003000000');
        $array  = Int32Array::fromString($binary);

        $this->assertEquals(3, count($array));
        $this->assertEquals(1, $array[0]);
        $this->assertEquals(2, $array[1]);
        $this->assertEquals(3, $array[2]);
    }
}