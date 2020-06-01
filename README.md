# dig

[![Packagist Version][ico-packagist]][link-packagist]
[![Packagist][ico-license]][link-license]
[![GitHub code size in bytes][ico-github-size]][link-github]
[![PHP from Packagist][ico-packagist-php-version]][link-packagist]
[![GitHub top language][ico-github-top-language]][link-github]

## Introduction

DNS resolver for PHP.

## Requirements

- PHP >= 7.1.0
- dnsutils

## Installation

Install the latest version with

```console
$ composer require superrosko/dig
```

### Docker

#### Git clone
```bash
git clone git@github.com:superrosko/dig.git .
```

#### Run initialization
```bash
make initial
```

## Usage

Domain names MUST be converted to punycode with idn_to_ascii!

### Docker

Restart docker compose:
```bash
make compose_restart
```
Install dependencies:
```bash
make deps_install
```
Update dependencies:
```bash
make deps_update
```
App php exec: 
```bash
make php_exec COMMAND="artisan"
```
App bash exec: 
```bash
make bash_exec
```
App initialization: 
```bash
make initial
```

## Credits

- [Dmitriy Bespalov][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File][link-license] for more information.

[link-author]: https://github.com/superrosko
[link-contributors]: https://github.com/superrosko/dig/contributors
[link-packagist]: https://packagist.org/packages/superrosko/dig
[link-github]: https://github.com/superrosko/dig
[link-license]: LICENSE

[ico-packagist]: https://img.shields.io/packagist/v/superrosko/dig.svg?style=flat
[ico-github-size]: https://img.shields.io/github/languages/code-size/superrosko/dig.svg?style=flat
[ico-github-top-language]: https://img.shields.io/github/languages/top/superrosko/dig.svg?style=flat
[ico-packagist-php-version]: https://img.shields.io/packagist/php-v/superrosko/dig.svg?style=flat
[ico-license]: https://img.shields.io/packagist/l/superrosko/dig.svg?style=flat