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
     * Parameter to save() indicating the cache item should be saved immediately.
     */
    const IMMEDIATE = false;

    /**
     * Parameter to save() indicating the cache item should be deferred to later.
     */
    const DEFER = true;

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
     * Returns a traversable set of cache items.
     *
     * @param array $keys
     * An indexed array of keys of items to retrieve.
     * @return array|\Traversable
     * A traversable collection of Cache Items keyed by the cache keys of
     * each item. A Cache item will be returned for each key, even if that
     * key is not found. However, if no keys are specified then an empty
     * traversable MUST be returned instead.
     */
    public function getItems(array $keys = array());

    /**
     * Deletes all items in the pool.
     *
     * @return boolean
     *   True if the pool was successfully cleared. False if there was an error.
     */
    public function clear();

    /**
     * Removes multiple items from the pool.
     *
     * @param array $keys
     * An array of keys that should be removed from the pool.
     * @return static
     * The invoked object.
     */
    public function deleteItems(array $keys);

    /**
     * @param CacheItemInterface $item
     *
     * @param bool $defer
     *   One of self::IMMEDIATE (the default) or self::DEFER. Determines
     *   whether the item should be saved to the cache immediately or
     *   deferred to later. If deferred, the cache item will not be saved
     *   until the commit() method is called.  That is to allow for multi-set
     *   operations supported by some caching implementations.
     * @return static
     *   The invoked object.
     */
    public function save(CacheItemInterface $item, $defer = self::IMMEDIATE);

    /**
     * Persists any deferred cache items.
     *
     * @return bool
     *   TRUE if all not-yet-saved items were successfully saved. FALSE otherwise.
     */
    public function commit();

}
