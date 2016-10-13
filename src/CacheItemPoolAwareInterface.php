<?php

namespace Psr\Cache;

/**
 * Describes a CacheItemPool-aware instance
 */
interface CacheItemPoolAwareInterface
{
    /**
     * Sets a CacheItemPool instance on the object
     *
     * @param CacheItemPoolInterface $CacheItemPool
     * @return null
     */
    public function setCacheItemPool(CacheItemPoolInterface $cacheItemPool);
}
