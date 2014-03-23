<?php

namespace Psr\Cache;

/**
 * An in-memory implementation of the Pool interface.
 */
class MemoryPool implements PoolInterface {

    /**
     * The stored data in this cache pool.
     *
     * @var array
     */
    protected $data = array();

    /**
     * {@inheritdoc}
     */
    public function getItem($key)
    {
        if (!array_key_exists($key, $this->data) || $this->data[$key]['ttd'] < new \DateTime()) {
            $this->data[$key] = [
                'value' => NULL,
                'hit' => FALSE,
                'ttd' => NULL,
            ];
        }

        return new MemoryCacheItem($this, $key, $this->data[$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function getItems(array $keys = array())
    {
        $collection = new MemoryCollection();
        foreach ($keys as $key) {
            $collection[$key] = $this->getItem($key);
        }
        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->data = [];
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteItems(array $keys)
    {
        foreach ($keys as $key) {
            unset($this->data[$key]);
        }
    }

    /**
     * @param $key
     * @param mixed $value
     *   The
     * @param \DateTime $expiration
     *   The time after which the saved item should be considered expired.
     */
    public function write($key, $value, \DateTime $expiration) {
        $this->data[$key] = [
            'value' => $value,
            'ttd' => $expiration,
            'hit' => TRUE,
        ];
    }
}
