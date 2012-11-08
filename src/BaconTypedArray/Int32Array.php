<?php
/**
 * BaconTypedArray
 *
 * @link      http://github.com/Bacon/BaconTypedArray For the canonical source repository
 * @copyright 2012 Ben 'DASPRiD' Scholzen
 * @license   http://opensource.org/licenses/BSD-2-Clause Simplified BSD License
 */

namespace BaconTypedArray;

/**
 * Int32 typed array.
 */
class Int32Array extends AbstractTypedArray
{
    /**
     * $typeSize: defined by AbstractTypedArray.
     *
     * @see AbstractTypedArray::$typeSize
     * @var integer
     */
    protected $typeSize = 4;

    /**
     * decode(): defined by AbstractTypedArray.
     *
     * @see    AbstractTypedArray::decode()
     * @param  string $value
     * @return integer
     */
    protected function decode($value)
    {
        $unpacked = unpack('I', $value);
        return $unpacked[1];
    }

    /**
     * encode(): defined by AbstractTypedArray.
     *
     * @see    AbstractTypedArray::encode()
     * @param  integer $value
     * @return void
     */
    protected function encode($value)
    {
        return pack('I', $value);
    }
}
