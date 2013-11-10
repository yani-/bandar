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
 * @category  Tests
 * @package   Bandar_Tests
 * @author    Yani Iliev <yani@iliev.me>
 * @copyright 2013 Yani Iliev
 * @license   https://raw.github.com/yani-/bandar/master/LICENSE The MIT License (MIT)
 * @version   GIT: 1.0.0
 * @link      https://github.com/yani-/bandar/
 */

/**
 * Unit test class
 *
 * @category  Tests
 * @package   Bandar_Tests
 * @author    Yani Iliev <yani@iliev.me>
 * @copyright 2013 Yani Iliev
 * @license   https://raw.github.com/yani-/bandar/master/LICENSE The MIT License (MIT)
 * @version   Release: 1.0.0
 * @link      https://github.com/yani-/bandar/
 */
class BandarTestGetTemplatesPathFromConstant extends PHPUnit_Framework_TestCase
{
    /**
     * [testSetTemplatesPathSetConstantPassNull description]
     *
     * @runInSeparateProcess
     *
     * @return void
     */
    public function testGetTemplatesPathFromConstant()
    {
        $bandar = new Bandar('dummy view');
        define('BANDAR_TEMPLATES_PATH', 'path/to/somewhere3');
        $this->assertEquals(
            'path/to/somewhere3',
            $bandar->getTemplatesPathFromConstant()
        );
    }

}

