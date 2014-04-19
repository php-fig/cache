<?php

namespace Psr\Cache;


/**
 * \Psr\Cache\CacheItemPoolInterface generates Cache\CacheItem objects.
 *
 * The primary purpose of Cache\CacheItemPoolInterface is to accept a key from the
 * Calling Library and return the associated Cache\CacheItemInterface object.
 * It is also the primary point of interaction with the entire cache collection.
 * All configuration and initialization of the Pool is left up to an Implementing
 * Library.
 */
interface CacheItemPoolInterface
{
    /**
     * Returns a Cache Item representing the specified key.
     *
     * This method must always return an ItemInterface object, even in case of
     * a cache miss. It MUST NOT return null.
     *
     * @param string $key
     *   The key for which to return the corresponding Cache Item.
     * @return \Psr\Cache\ItemInterface
     *   The corresponding Cache Item.
     * @throws \Psr\Cache\InvalidArgumentException
     *   If the $key string is not a legal value a \Psr\Cache\InvalidArgumentException
     *   MUST be thrown.
     */
    public function getItem($key);

    /**
     * Deletes all items in the pool.
     *
     * @return boolean
     *   True if the pool was successfully cleared. False if there was an error.
     */
    public function clear();
}
