# Bandar

[![Build Status](https://travis-ci.org/yani-/bandar.png?branch=develop)](https://travis-ci.org/yani-/bandar)
[![Code Coverage](https://scrutinizer-ci.com/g/yani-/bandar/badges/coverage.png?s=c40636c2454c21b02833b845177f72708ac66d80)](https://scrutinizer-ci.com/g/yani-/bandar/)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/yani-/bandar/badges/quality-score.png?s=dafa1ca61bb087fd0ed911b8376a01920fe2477f)](https://scrutinizer-ci.com/g/yani-/bandar/)
[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/yani-/bandar/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

Fully tested minimalistic PHP template engine. Include the class, set your templates location and start rendering.

### Getting Started
```php
// test.php
require_once 'lib/Bandar.php';
define('BANDAR_TEMPLATES_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views');
$bandar = new Bandar;
$bandar->render('users/list', array('users' => array('name' => 'John Smith')));
```
```php
// views/users/list.php
foreach ($users as $user) {
    echo $user->name;
}
```
Alternative initialization of templates path
```php
// test.php
require_once 'lib/Bandar.php';
$bandar = new Bandar('BANDAR_TEMPLATES_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views');
$bandar->render('users/list', array('users' => array('name' => 'John Smith')));
```
Finally run it
```bash
php test.php
```

### Tests
Coverage reports are stored inside the coverage folder. The goal is to always have 100% coverage.
```bash
phpunit
```

### Documentation
```bash
phpdoc -f lib/Bandar.php
```

### Contributing
For code guidelines refer to `.editorconfig`. This project is following PEAR code standard - http://pear.php.net/manual/en/standards.php

### License
MIT
