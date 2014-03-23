<?php

namespace Psr\Cache;

/**
 * Common backend-agnostic implementation of a cache Collection.
 *
 * Classes using this trait MUST declare that they implement
 * \IteratorAggregate, and that must come before CollectionInterface
 * in the implements list.
 *
 * This implementation will likely be suboptimally performant on
 * cache engines that support bulk operations natively.
 *
 * @implements \Psr\Cache\CollectionInterface
 */
trait BasicCollectionTrait {

    /**
     * The items held by this collection.
     *
     * @var ItemInterface[]
     */
    protected $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * {@inheritdoc}
     */
    public function save()
    {
        foreach ($this->items as $item) {
            $item->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->items);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->items[$offset] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
}
