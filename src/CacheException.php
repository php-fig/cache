<?php

namespace Psr\Cache;

/**
 * Exception interface for all exceptions thrown by an Implementing Library.
 */
if (interface_exists('Throwable')) {
    interface CacheException extends \Throwable
    {
    }
} else {
    interface CacheException
    {
    }
}
