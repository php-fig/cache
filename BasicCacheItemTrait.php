<?php

namespace Psr\Cache;


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
    protected $ttd;

    /**
     * {@inheritdoc}
     */
    function getKey()
    {
        return $this->key;
    }

    /**
     * {@inheritdoc}
     */
    function get()
    {
        return $this->isHit() ? $this->value : NULL;
    }

    /**
     * {@inheritdoc}
     */
    function set($value, $ttl = null)
    {
        $this->value = $value;
        $this->setTtd($ttl);
        return $this;
    }

    function save($value = null, $ttl = null) {
        if ($value) {
            $this->set($value, $ttl);
        }
        $this->write($this->key, $this->value, $this->ttd);
    }

    protected function setTtd($ttl) {
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
     * {@inheritdoc}
     */
    function isHit()
    {
        return $this->hit;
    }

    /**
     * {@inheritdoc}
     */
    function delete()
    {
        $this->db->delete($this->key);
    }

    /**
     * {@inheritdoc}
     */
    function exists()
    {
        return $this->hit;
    }

    /**
     * Commits this cache item to storage.
     *
     * @param $key
     *   The key of the cache item to save.
     * @param $value
     *   The value to save. It should not be serialized.
     * @param \DateTime $ttd
     *   The timestamp after which this cache item should be considered expired.
     */
    protected abstract function write($key, $value, \DateTime $ttd);
}
