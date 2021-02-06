# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## [3.0.0](https://github.com/php-fig/cache/compare/2.0.0...3.0.0) - 2021-02-04

### Changed

- **BREAKING** All methods have return types

## [2.0.0](https://github.com/php-fig/cache/compare/1.0.1...2.0.0) - 2021-02-04

### Changed

- **BREAKING** The `CacheItemInterface::expiresAt()` method’s `$expiration` parameter is typehinted with `DateTimeInterface`, see [this explanation](https://www.php-fig.org/psr/psr-6/meta/#82-type-additions)
- All methods have typed parameters
- `Psr\Cache\CacheException` extends `Throwable`
- Bump required PHP version to 8.0

## [1.0.1](https://github.com/php-fig/cache/compare/1.0.0...1.0.1) - 2016-08-06

### Fixed

- Make spacing consistent in phpdoc annotations php-fig/cache#9 - chalasr
- Fix grammar in phpdoc annotations php-fig/cache#10 - chalasr
- Be more specific in docblocks that `getItems()` and `deleteItems()` take an array of strings (`string[]`) compared to just `array` php-fig/cache#8 - GrahamCampbell
- For `expiresAt()` and `expiresAfter()` in CacheItemInterface fix docblock to specify null as a valid parameters as well as an implementation of DateTimeInterface php-fig/cache#7 - GrahamCampbell

## 1.0.0 - 2015-12-11

Initial stable release; reflects accepted PSR-6 specification
