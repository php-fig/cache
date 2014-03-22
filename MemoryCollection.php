<?php

namespace Psr\Cache;


class MemoryCollection implements \IteratorAggregate, CollectionInterface {
    use BasicCollectionTrait;

    /**
     * @var MemoryPool
     */
    protected $pool;

    function __construct(MemoryPool $pool)
    {
        $this->pool = $pool;
    }


    public function save()
    {
        foreach ($this->items as $item) {
            $item->save();
        }
    }

}
