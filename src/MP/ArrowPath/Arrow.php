<?php

namespace MP\ArrowPath;


class Arrow implements \ArrayAccess, \Countable
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var bool
     */
    private $naive;

    /**
     * Arrow constructor.
     * @param mixed $data
     * @param bool  $naive
     */
    public function __construct(array $data, $naive = false)
    {
        $this->data = $data;
        $this->naive = $naive;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->data) || $this->naive;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->__set($offset, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * @param $name
     * @return Arrow
     */
    public function __get($name)
    {
        if (is_array($this->data[$name] ?? null) || (!isset($this->data[$name]) && $this->naive)) {
            return new self($this->data[$name] ?? [], $this->naive);
        }

        return $this->data[$name] ?? null;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->data);
    }

    /**
     * @param $name
     * @param $arguments
     * @return array|mixed|null
     */
    public function __call($name, $arguments)
    {
        return count($this->data) ? $this->data : $arguments[0] ?? null;
    }

    /**
     * Return raw value
     * @param null $default
     * @return array|mixed|null
     */
    public function val($default = null)
    {
        return $this->__call('_', [$default]);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->__call('_', null);
    }
}
