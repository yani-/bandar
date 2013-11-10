<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Short description for file
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  Examples
 * @package   Bandar
 * @author    Yani Iliev <yani@iliev.me>
 * @copyright 2013 Yani Iliev
 * @license   https://raw.github.com/yani-/bandar/master/LICENSE The MIT License (MIT)
 * @version   GIT: 1.0.0
 * @link      https://github.com/yani-/bandar/
 */
require_once
    dirname(__FILE__) .
    DIRECTORY_SEPARATOR . '..' .
    DIRECTORY_SEPARATOR . 'lib' .
    DIRECTORY_SEPARATOR . 'Bandar.php';

/**
 * Set BANDAR_VIEW_PATH to the path of your views folder
 * Alternatively you can call Bandar::setup($path) and pass your path as an
 * argument to the function
 */
define(
    'BANDAR_VIEW_PATH',
    dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views'
);

/**
 * Altenative views folder configuration. Note that BANDAR_VIEW_PATH constant
 * takes precedence if it is set
 */
Bandar::setup(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'views');

/**
 * Render index.php file, note that the file extension must be omitted
 * Arguments are passed as second parameter of the render function and must be
 * an array
 */
Bandar::render('index', array('name' => 'Hello World'));

/**
 * Altenative passing of parameters
 */
$args = array('name' => 'Hello World Alternative');
Bandar::render('index', $args);
