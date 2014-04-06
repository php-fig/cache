<?php

namespace Psr\Cache;

/**
 * Basic implementation of a backend-agnostic cache item.
 *
 * @implements \Psr\Cache\ItemInterface
 */
trait BasicCacheItemTrait {

    /**
     * @var string
     */
    protected $key;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var boolean
     */
    protected $hit;

    /**
     * @var \DateTime
     */
    protected $expiration;

    /**
     * {@inheritdoc}
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        return $this->isHit() ? $this->value : NULL;
    }

    /**
     * {@inheritdoc}
     */
    public function set($value, $ttl = null)
    {
        $this->value = $value;
        $this->setExpiration($ttl);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function save($value = null, $ttl = null)
    {
        if ($value) {
            $this->set($value, $ttl);
        }
        return $this->write($this->key, $this->value, $this->ttd);
    }

    /**
     * {@inheritdoc}
     */
    public function isHit()
    {
        return $this->hit;
    }

    /**
     * {@inheritdoc}
     */
    public function delete()
    {
        $this->db->delete($this->key);
    }

    /**
     * {@inheritdoc}
     */
    public function exists()
    {
        return $this->hit;
    }

    /**
     * Sets the expiration for this cache item.
     *
     * @param mixed $ttl
     *   The TTL to convert to a DateTime expiration.
     */
    protected function setExpiration($ttl) {
        if ($ttl instanceof \DateTime) {
            $this->ttd = $ttl;
        }
        elseif (is_int($ttl)) {
            $this->ttd = new \DateTime('now +' . $ttl . ' seconds');
        }
        elseif (is_null($this->ttd)) {
            $this->ttd = new \DateTime('now +1 year');
        }
    }

    /**
     * Commits this cache item to storage.
     *
     * @param $key
     *   The key of the cache item to save.
     * @param $value
     *   The value to save. It should not be serialized.
     * @param \DateTime $expiration
     *   The timestamp after which this cache item should be considered expired.
     * @return boolean
     *   Returns true if the item was successfully committed, or false if there was
     *   an error.
     */
    protected abstract function write($key, $value, \DateTime $expiration);
}
