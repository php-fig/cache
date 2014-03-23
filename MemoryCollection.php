<?php

namespace Psr\Cache;

/**
 * In-memory implementation of a cache Collection.
 */
class MemoryCollection implements \IteratorAggregate, CollectionInterface {
    use BasicCollectionTrait;
}
