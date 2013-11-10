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
    public static $view_path = null;

    /**
     * Setup the template engine
     *
     * @param string $view_path Path to template files
     *
     * @return [type] [description]
     */
    public static function setup($view_path)
    {
        self::$view_path = $view_path;
    }

    /**
     * Render a template
     *
     * @param string $view Template name
     * @param array  $args Variables to pass to the template file
     *
     * @return string Contents of the template
     */
    public static function render($view, $args=array())
    {
        // replacing directory separator with the default one for the OS
        $view = str_replace('/', DIRECTORY_SEPARATOR, $view);
        // validate that the config is valid
        self::checkConfig();
        // validate that the view file exists
        self::validateView($view);
        // extracting passed aguments
        extract($args);
        ob_start();
        // including the view
        include self::getViewPath() . DIRECTORY_SEPARATOR . $view . '.php';
        return ob_get_flush();
    }

    /**
     * [validateView description]
     *
     * @param string $view Template file
     *
     * @return void
     */
    public static function validateView($view)
    {
        if (!file_exists(self::getPathToView($view))) {
            trigger_error(
                'The file you are trying to see `' .
                self::getPathToView($view) .
                '` doesn\'t exist.',
                E_USER_ERROR
            );
        }
    }

    /**
     * [checkConfig description]
     *
     * @return void
     */
    public static function checkConfig()
    {
        if (is_null(self::getViewPath())) {
            trigger_error(
                'You need to setup the engine before using it.',
                E_USER_ERROR
            );
        }
    }

    /**
     * [getViewPath description]
     *
     * @return string|null View path
     */
    public static function getViewPath()
    {
        // if self::$view_path is set return it, else return the the
        // value of BANDAR_VIEW_PATH const
        return defined('BANDAR_VIEW_PATH') ? BANDAR_VIEW_PATH
                                           : self::$view_path;
    }

    /**
     * [getPathToView description]
     *
     * @param string $view Template file
     *
     * @return string       Path to template file
     */
    public static function getPathToView($view)
    {
        return self::getViewPath() . DIRECTORY_SEPARATOR . $view . '.php';
    }
}
