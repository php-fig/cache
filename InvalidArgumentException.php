<?php

namespace Psr\Cache;

/**
 * Exception interface for invalid cache arguements.
 *
 * Any time an invalid argument is passed into a method it must throw an
 * exception class which implements Psr\Cache\InvalidArgumentException.
 */
interface InvalidArgumentException { }
