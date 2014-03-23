<?php

namespace Psr\Cache;


/**
 * ItemInterface defines an interface for interacting with objects inside a cache.
 *
 * ItemInterface defines an item inside a cache system.  Each Item object
 * MUST be associated with a specific key, which can be set according to the
 * implementing system and is typically passed by the Cache\PoolInterface object.
 */
interface ItemInterface
{
    /**
     * Returns the key for the current cache item.
     *
     * The key is loaded by the Implementing Library, but should be available to
     * the higher level callers when needed.
     *
     * @return string
     *   The key string for this cache item.
     */
    public function getKey();

    /**
     * Retrieves the value of the item from the cache associated with this objects key.
     *
     * The value returned must be identical to the value original stored by set().
     *
     * if isHit() returns false, this method MUST return null. Note that null
     * is a legitimate cached value, so the isHit() method SHOULD be used to
     * differentiate between "null value was found" and "no value was found."
     *
     * @return mixed
     *   The value corresponding to this cache item's key, or null if not found.
     */
    public function get();

    /**
     * Sets the value represented by this cache item.
     *
     * The $value argument may be any item that can be serialized by PHP,
     * although the method of serialization is left up to the Implementing
     * Library.
     *
     * Implementing Libraries MAY provide a default TTL if one is not specified.
     * If no TTL is specified and no default TTL has been set, the TTL MUST
     * be set to the maximum possible duration of the underlying storage
     * mechanism, or permanent if possible.
     *
     * @param mixed $value
     *   The serializable value to be stored.
     * @param int|\DateTime $ttl
     *   - If an integer is passed, it is interpreted as the number of seconds
     *     after which the item MUST be considered expired.
     *   - If a DateTime object is passed, it is interpreted as the point in
     *     time after which the the item MUST be considered expired.
     *   - If no value is passed, a default value MAY be used. If none is set,
     *     the value should be stored permanently or for as long as the
     *     implementation allows.
     * @return static
     *   Returns true if the item was successfully saved, or false if there was
     *   an error.
     */
    public function set($value, $ttl = null);

    /**
     * Saves a value into the cache.
     *
     * The $value argument may be any item that can be serialized by PHP,
     * although the method of serialization is left up to the Implementing
     * Library.
     *
     * Calling this method with no parameters will persist the current value
     * without changes.  Calling it with parameters is equivalent to calling
     * set() with the same parameters, then persisting.  That is, the following
     * lines have identical impact.
     *
     * $item->set('a value', 300)->save();
     * $item->save('a value', 300);
     *
     * @param mixed $value
     *   The serializable value to be stored.
     * @param null $ttl
     * @param int|\DateTime $ttl
     *   - If an integer is passed, it is interpreted as the number of seconds
     *     after which the item MUST be considered expired.
     *   - If a DateTime object is passed, it is interpreted as the point in
     *     time after which the the item MUST be considered expired.
     *   - If no value is passed, a default value MAY be used. If none is set,
     *     the value should be stored permanently or for as long as the
     *     implementation allows.
     * @return boolean
     *   Returns true if the item was successfully saved, or false if there was
     *   an error.
     */
    public function save($value = null, $ttl = null);

    /**
     * Confirms if the cache item lookup resulted in a cache hit.
     *
     * Note: This method MUST NOT have a race condition between calling isHit()
     * and calling get().
     *
     * @return boolean
     *   True if the request resulted in a cache hit.  False otherwise.
     */
    public function isHit();

    /**
     * Removes the current key from the cache.
     *
     * @return boolean
     *   Returns true if the item was deleted or if it did not exist in the
     *   first place, or false if there was an error.
     */
    public function delete();

    /**
     * Confirms if the cache item exists in the cache.
     *
     * Note: This method MAY avoid retrieving the cached value for performance
     * reasons, which could result in a race condition between exists() and get().
     * To avoid that potential race condition use isHit() instead.
     *
     * @return boolean
     *  True if item exists in the cache, false otherwise.
     */
    public function exists();

}
