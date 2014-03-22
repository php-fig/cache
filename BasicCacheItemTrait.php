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
        if (func_num_args() == 2) {
            if ($ttl instanceof \DateTime) {
                $this->ttd = $ttl;
            }
            else {
                $this->ttd = new \DateTime('now +' . $ttl . ' seconds');
            }
        }
    }

    function save($value = null, $ttl = null) {
        if ($value) {
            $this->set($value, $ttl);
        }
        $this->write($this->key, $this->value, $this->ttd);
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
