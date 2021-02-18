# Pollen Debug Component

[![Latest Version](https://img.shields.io/badge/release-1.0.0-blue?style=for-the-badge)](https://www.presstify.com/pollen-solutions/debug/)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-green?style=for-the-badge)](LICENSE.md)
[![PHP Supported Versions](https://img.shields.io/badge/PHP->=7.4-8892BF?style=for-the-badge&logo=php)](https://www.php.net/supported-versions.php)

Pollen **Debug** Component provides a collection of tools dedicated to debugging.

## Installation

```bash
composer require pollen-solutions/debug
```

## Basic Usage

### ErrorHandler

```php
use Pollen\Debug\DebugManager;

// DebugManager instantiation
$debug = new DebugManager();

// ErrorHandler activation
$debug->errorHandler()->enable();

// ErrorHandler test
function errorHandlerTest()
{
    throw new InvalidArgumentException('Test de Whoops');
}
errorHandlerTest();
```

### DebugBar

```php
use Pollen\Debug\DebugManager;

// DebugManager instantiation
$debug = new DebugManager();

// DebugBar activation
$debug->debugBar()->enable();

// DebugBar test
echo <<< HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Debug Bar Test</title>
HTML;

// DebugBar head assets
echo $debug->debugBar()->renderHead();

echo <<< HTML
</head>
<body>
HTML;

// DebugBar render
echo $debug->debugBar()->render();

echo <<< HTML
</body>
</html>
HTML;
exit;
```