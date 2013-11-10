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
class BandarTestRender extends PHPUnit_Framework_TestCase
{
    /**
     * [testTemplateExists description]
     *
     * @runInSeparateProcess
     *
     * @return void
     */
    public function testRender()
    {
        $bandar = new Bandar(
            dirname(__FILE__) . DIRECTORY_SEPARATOR . 'templates'
        );
        ob_start();
        $bandar->render('users/list', array('name' => 'John Smith'));
        $renderedContent = ob_get_clean();
        $this->assertEquals(
            'Hello John Smith',
            $renderedContent
        );
    }

    /**
     * [testTemplateExists description]
     *
     * @runInSeparateProcess
     *
     * @return void
     */
    public function testRenderWithConstantDefined()
    {
        define(
            'BANDAR_TEMPLATES_PATH',
            dirname(__FILE__) . DIRECTORY_SEPARATOR . 'templates'
        );
        $bandar = new Bandar();
        ob_start();
        $bandar->render('users/list', array('name' => 'John Smith'));
        $renderedContent = ob_get_clean();
        $this->assertEquals(
            'Hello John Smith',
            $renderedContent
        );
    }

    /**
     * [testRenderInvalidFile description]
     *
     * @expectedException TemplateDoesNotExistException
     *
     * @return void
     */
    public function testRenderInvalidFile()
    {
        $bandar = new Bandar(
            dirname(__FILE__) . DIRECTORY_SEPARATOR . 'templates'
        );
        ob_start();
        $bandar->render('does-not-exist', array('name' => 'John Smith'));
        $renderedContent = ob_get_clean();
        $this->assertEquals(
            'Hello John Smith',
            $renderedContent
        );
    }
}

