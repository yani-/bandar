<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Provides unit tests for Bandar template engine
 *
 * PHP version 5
 *
 * LICENSE: Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the "Software"), to
 * deal in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
 * of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 * IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @category  Tests
 * @package   Bandar_Tests
 * @author    Yani Iliev <yani@iliev.me>
 * @copyright 2013 Yani Iliev
 * @license   https://raw.github.com/yani-/bandar/master/LICENSE The MIT License (MIT)
 * @version   GIT: 1.0.1
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
class BandarTest extends PHPUnit_Framework_TestCase
{
    /**
     * [testInitBandar description]
     *
     * @return Instance of Bandar
     */
    public function testInitBandar()
    {
        $bandar = new Bandar('dummy view');
        $this->assertInstanceOf('Bandar', $bandar);

        return $bandar;
    }

    /**
     * [testSetTemplatesPathPassNull description]
     *
     * @param Bandar $bandar Instance of Bandar
     *
     * @depends testInitBandar
     * @expectedException TemplatesPathNotSetException
     *
     * @return void
     */
    public function testSetTemplatesPathPassNull($bandar)
    {
        $bandar->setTemplatesPath(null);
    }

    /**
     * [testSetTemplatesPathSetConstantPassNull description]
     *
     * @param Bandar $bandar Instance of Bandar
     *
     * @depends testInitBandar
     *
     * @return void
     */
    public function testSetTemplatesPathSetConstantPassNull($bandar)
    {
        define('BANDAR_TEMPLATES_PATH', 'path/to/somewhere');
        $bandar->setTemplatesPath(null);
        $this->assertEquals(
            'path/to/somewhere',
            $bandar->templatesPath
        );
    }

    /**
     * [testSetTemplatesPathSetConstantPassNull description]
     *
     * @param Bandar $bandar Instance of Bandar
     *
     * @depends testInitBandar
     *
     * @return void
     */
    public function testSetTemplatesPath($bandar)
    {
        $bandar->setTemplatesPath('path/to/somewhere2');
        $this->assertEquals(
            'path/to/somewhere2',
            $bandar->templatesPath
        );
    }

    /**
     * [testGetTemplatesPath description]
     *
     * @param Bandar $bandar Instance of Bandar
     *
     * @depends testInitBandar
     *
     * @return void
     */
    public function testGetTemplatesPath($bandar)
    {
        $bandar->templatesPath = 'some/path/to/test';
        $this->assertEquals(
            'some/path/to/test',
            $bandar->getTemplatesPath()
        );
    }

    /**
     * [testSetTemplateThatDoesNotExist description]
     *
     * @param Bandar $bandar Instance of Bandar
     *
     * @depends testInitBandar
     * @expectedException TemplateDoesNotExistException
     *
     * @return void
     */
    public function testSetTemplateThatDoesNotExist($bandar)
    {
        $bandar->setTemplate('this-template-does-not-exist');
    }

    /**
     * [testSetTemplate description]
     *
     * @param Bandar $bandar Instance of Bandar
     *
     * @depends testInitBandar
     * @depends testSetTemplatesPath
     *
     * @return void
     */
    public function testSetTemplate($bandar)
    {
        $bandar->setTemplatesPath(
            dirname(__FILE__) . DIRECTORY_SEPARATOR . 'templates'
        );
        $bandar->setTemplate('users/list');
        $this->assertEquals(
            'users' . DIRECTORY_SEPARATOR . 'list.php',
            $bandar->template
        );
    }

    /**
     * [testGetTemplate description]
     *
     * @param Bandar $bandar Instance of Bandar
     *
     * @depends testInitBandar
     * @depends testSetTemplatesPath
     *
     * @return void
     */
    public function testGetTemplate($bandar)
    {
        $bandar->template = 'some-file-to-test.php';
        $this->assertEquals(
            'some-file-to-test.php',
            $bandar->getTemplate()
        );
    }

    /**
     * [testTemplateExists description]
     *
     * @param Bandar $bandar Instance of Bandar
     *
     * @depends testInitBandar
     * @depends testSetTemplatesPath
     * @depends testSetTemplate
     *
     * @return void
     */
    public function testTemplateExists($bandar)
    {
        $bandar->setTemplatesPath(
            dirname(__FILE__) . DIRECTORY_SEPARATOR . 'templates'
        );
        $this->assertTrue(
            $bandar->templateExists('users' . DIRECTORY_SEPARATOR . 'list.php')
        );
        $this->assertFalse(
            $bandar->templateExists('does-not-exist.php')
        );
    }
}

