<?php


namespace usamawaleed\AWeber\Model\Collection;


use \Countable;
use \ArrayAccess;
use \IteratorAggregate;

abstract class AbstractCollection implements Countable, ArrayAccess, IteratorAggregate
{
    private $collection = [];
    protected $entityClassType = \StdClass::class;
    protected $getPk;

    public function addItem($item, $key = null)
    {
        $this->offsetSet($item, $key);
    }

    public function remove($item)
    {
        $this->offsetUnset($item);
    }

    public function get($key)
    {
        return $this->offsetGet($key);
    }

    public function exists($key)
    {
        return $this->offsetExists($key);
    }

    public function clear()
    {
        $this->collection = [];
    }

    public function toArray()
    {
        return $this->collection;
    }

    public function count()
    {
        return count($this->collection);
    }

    public function offsetSet($value, $key = null)
    {
        if (!$value instanceof $this->entityClassType) {
            throw new \InvalidArgumentException('Unable to add item into the collection.');
        }
        if (!isset($key)) {
            $key = $value->{$this->getPk}();
            if (empty($key)) {
                $this->collection[] = $value;
            } else {
                $this->collection[$key] = $value;
            }
        } else {
            $this->collection[$key] = $value;
        }
    }

    public function offsetGet($key)
    {
        if (isset($this->collection[$key])) {
            return $this->collection[$key];
        }
        return null;
    }

    public function offsetUnset($key)
    {
        if ($key instanceof $this->entityClassType) {
            $this->collection = array_filter($this->collection,
                function ($v) use ($key) {
                    return $v !== $key;
                });
        } elseif (isset($this->collection[$key])) {
            unset($this->collection[$key]);
        }
    }

    public function offsetExists($key)
    {
        if ($key instanceof $this->entityClassType) {
            return array_search($key, $this->collection);
        }
        return isset($this->collection[$key]);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->collection);
    }

}
