<?php

namespace Psr\Cache;


class MemoryPool implements PoolInterface {
    use BasicPoolTrait;

    protected $data = array();

    function getItem($key)
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

    function getItems(array $keys)
    {
        $collection = new MemoryCollection($this);
        foreach ($keys as $key) {
            $collection[$key] = $this->getItem($key);
        }
        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    function clear()
    {
        $this->data = [];
        return $this;
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

    public function write($key, $value, \DateTime $ttd) {
        $this->data[$key] = [
            'value' => $value,
            'ttd' => $ttd,
            'hit' => TRUE,
        ];
    }
}
