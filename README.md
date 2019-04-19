# Fetch RSS/Atom to CSV

Recruitment task. CLI app fetching Atom/RSS data into a CSV file

- [Installation](#installation)
- [Usage](#usage)
- [Testing](#testing)


## Installation

Run this command in terminal

``` sh
composer install
```


## Usage

`<URL>` - Atom/RSS feed URL

`<PATH>` - Path to CSV file in which we will save RSS feed

``` sh
php src/console.php <URL> <PATH>
```


## Testing

``` bash
$ vendor/bin/phpunit
```
