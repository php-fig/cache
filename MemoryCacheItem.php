<?php

namespace Psr\Cache;

/**
 * In-memory implementation of a cache item.
 */
class MemoryCacheItem implements ItemInterface {
    use BasicCacheItemTrait;

    /**
     * @var MemoryPool
     */
    protected $pool;

    public function  __construct(MemoryPool $pool, $key, array $data) {
        $this->pool = $pool;
        $this->key = $key;
        $this->value = $data['value'];
        $this->ttd = $data['ttd'];
        $this->hit = $data['hit'];
    }

    /**
     * {@inheritdoc}
     */
    protected function write($key, $value, \DateTime $ttd) {
      $this->pool->write($key, $value, $ttd);
    }

}
