<?php
namespace BaconTypedArray;

use ArrayAccess;
use Countable;

/**
 * Abstract class for all typed arrays.
 */
abstract class AbstractTypedArray implements
    ArrayAccess,
    Countable
{
    /**
     * Buffer holding the encoded data.
     *
     * @var string
     */
    protected $buffer = '';

    /**
     * Size of the implemented type in bytes.
     *
     * @var integer
     */
    protected $typeSize = 1;

    /**
     * Create a new typed array.
     *
     * @param array $values
     */
    public function __construct(array $values = null)
    {
        if ($values !== null) {
            $i = 0;

            foreach ($values as $value) {
                $this[$i++] = $value;
            }
        }
    }

    /**
     * count(): defined by Countable.
     *
     * @see    Countable::count()
     * @return integer
     */
    public function count()
    {
        return strlen($this->buffer) / $this->typeSize;
    }

    /**
     * offsetExists(): defined by ArrayAccess.
     *
     * @see    ArrayAccess::offsetExists()
     * @param  integer $offset
     * @return boolean
     * @throws \OutOfBoundsException
     */
    public function offsetExists($offset)
    {
        if (!is_int($offset) || $offset < 0) {
            throw new \OutOfBoundsException('Offset must be an integer and greater than 0');
        }

        if (strlen($this->buffer) / $this->typeSize < $offset) {
            return false;
        }

        return true;
    }

    /**
     * offsetGet(): defined by ArrayAccess.
     *
     * @see    ArrayAccess::offsetGet()
     * @param  integer $offset
     * @return mixed
     * @throws \OutOfBoundsException
     */
    public function offsetGet($offset)
    {
        if (!is_int($offset) || $offset < 0) {
            throw new \OutOfBoundsException('Offset must be an integer and greater than 0');
        }

        if (strlen($this->buffer) / $this->typeSize < $offset) {
            return null;
        }

        $value = substr($this->buffer, $offset * $this->typeSize, $this->typeSize);

        if (strlen($value) < $this->typeSize) {
            throw new \RuntimeException('Value from buffer too small');
        }

        return $this->decode($value);
    }

    /**
     * offsetSet(): defined by ArrayAccess.
     *
     * @see    ArrayAccess::offsetSet()
     * @param  integer|null $offset
     * @param  mixed        $value
     * @return void
     * @throws \OutOfBoundsException
     */
    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            $offset = strlen($this->buffer) / $this->typeSize;
        } elseif (!is_int($offset) || $offset < 0) {
            throw new \OutOfBoundsException('Offset must be an integer and greater than 0');
        }

        $encoded = $this->encode($value);

        if (strlen($encoded) < $this->typeSize) {
            throw new \RuntimeException('Encoded value too small');
        }

        if (strlen($this->buffer) <= $offset * $this->typeSize) {
            $this->buffer .= $encoded;
        } else {
            for ($i = 0; $i < $this->typeSize; $i++) {
                $this->buffer[$offset * $this->typeSize + $i] = $encoded[$i];
            }
        }
    }

    /**
     * offsetUnset(): defined by ArrayAccess.
     *
     * @see    ArrayAccess::offsetUnset()
     * @param  integer $offset
     * @return void
     * @throws \OutOfBoundsException
     */
    public function offsetUnset($offset)
    {
        if (!is_int($offset) || $offset < 0) {
            throw new \OutOfBoundsException('Offset must be an integer and greater than 0');
        }

        if (strlen($this->buffer) / $this->typeSize < $offset) {
            return;
        }

        for ($i = 0; $i < $this->typeSize; $i++) {
            $this->buffer[$offset * $this->typeSize + $i] = "\0";
        }
    }

    /**
     * Decode a value.
     *
     * @param  string $value
     * @return mixed
     */
    abstract protected function decode($value);

    /**
     * Encode a value
     *
     * @param  mixed $value
     * @return string
     */
    abstract protected function encode($value);
}
