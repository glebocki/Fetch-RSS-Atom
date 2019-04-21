# Fetch RSS/Atom

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
php src/console.php csv:simple <URL> <PATH>
php src/console.php csv:extended <URL> <PATH>
```

Example:
``` sh
php src/console.php csv:simple http://feeds.nationalgeographic.com/ng/News/News_Main simple_export
```


## Testing

``` bash
$ vendor/bin/phpunit
```
