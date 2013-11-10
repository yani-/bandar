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
 * @category  Templates
 * @package   Bandar
 * @author    Yani Iliev <yani@iliev.me>
 * @copyright 2013 Yani Iliev
 * @license   https://raw.github.com/yani-/bandar/master/LICENSE The MIT License (MIT)
 * @version   GIT: 1.0.0
 * @link      https://github.com/yani-/bandar/
 */

/**
 * Include exceptions
 */
require_once
    dirname(__FILE__) .
    DIRECTORY_SEPARATOR .
    'Exceptions' .
    DIRECTORY_SEPARATOR .
    'TemplatesPathNotSetException.php';
require_once
    dirname(__FILE__) .
    DIRECTORY_SEPARATOR .
    'Exceptions' .
    DIRECTORY_SEPARATOR .
    'TemplateDoesNotExistException.php';

/**
 * Bandar Main class
 *
 * @category  Templates
 * @package   Bandar
 * @author    Yani Iliev <yani@iliev.me>
 * @copyright 2013 Yani Iliev
 * @license   https://raw.github.com/yani-/bandar/master/LICENSE The MIT License (MIT)
 * @version   Release: 1.0.0
 * @link      https://github.com/yani-/bandar/
 */
class Bandar
{
    /**
     * Path to template files
     *
     * @var string|null
     */
    public $templatesPath = null;

    /**
     * Template file to output
     * @var string|null
     */
    public $template = null;

    /**
     * Initializes the class and sets templatesPath
     *
     * @param string|null $templatesPath Path to templates folder
     */
    public function __construct($templatesPath = null)
    {
        $this->setTemplatesPath($templatesPath);
    }

    /**
     * Setter for templatesPath
     *
     * @param string|null $templatesPath Templates path
     *
     * @return Instance of Bandar
     */
    public function setTemplatesPath($templatesPath)
    {
        if (is_null($templatesPath)) {
            // no view path is passed, use BANDAR_TEMPLATES_PATH
            $this->templatesPath = $this->getTemplatesPathFromConstant();
        } else {
            $this->templatesPath = $templatesPath;
        }
        return $this;
    }

    /**
     * Retrieves templatesPath from BANDAR_TEMPLATES_PATH constant
     *
     * @throws TemplatesPathNotSetException If BANDAR_TEMPLATES_PATH is not defined
     *
     * @return string Templates path
     */
    public function getTemplatesPathFromConstant()
    {
        if (!defined('BANDAR_TEMPLATES_PATH')) {
            throw new TemplatesPathNotSetException;
        } else {
            return BANDAR_TEMPLATES_PATH;
        }
    }

    /**
     * Getter for templatesPath
     *
     * @return string Template path
     */
    public function getTemplatesPath()
    {
        return $this->templatesPath;
    }

    /**
     * Setter for template
     *
     * @param string $template Template file
     *
     * @throws TemplateDoesNotExistException If template file is not found
     *
     * @return Instance of Bandar
     */
    public function setTemplate($template)
    {
        // replacing directory separator with the default one for the OS
        $template = str_replace('/', DIRECTORY_SEPARATOR, $template) . '.php';

        if ($this->templateExists($template)) {
            $this->template = $template;
        } else {
            throw new TemplateDoesNotExistException;
        }
        return $this;
    }

    /**
     * Checks if template exists by using file_exists
     *
     * @param string $template Template file
     *
     * @return boolean
     */
    public function templateExists($template)
    {
        return file_exists(
            $this->getTemplatesPath() . DIRECTORY_SEPARATOR . $template
        );
    }

    /**
     * Getter for template
     *
     * @return string Template file with path
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Renders a passed template
     *
     * @param string $template Template name
     * @param array  $args     Variables to pass to the template file
     *
     * @return string Contents of the template
     */
    public function render($template, $args=array())
    {
        $this->setTemplate($template);
        // extracting passed aguments
        extract($args);
        ob_start();
        // including the view
        include
            $this->getTemplatesPath() .
            DIRECTORY_SEPARATOR .
            $this->getTemplate();

        return ob_get_flush();
    }
}
