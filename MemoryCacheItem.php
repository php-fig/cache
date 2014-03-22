<?php
/**
 * Created by PhpStorm.
 * User: crell
 * Date: 3/22/14
 * Time: 4:51 PM
 */

namespace Psr\Cache;


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

    protected function write($key, $value, \DateTime $ttd) {
      $this->pool->write($key, $value, $ttd);
    }

}
