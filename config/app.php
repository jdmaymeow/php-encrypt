<?php
/**
 * Core Configurations.
 *
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) May Meow
 * @copyright     Copyright (c) GitlabCafe community
 * @link          https://github.com/jdmaymeow May Meow
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

/**
 * The full path to the directory which holds "src", WITHOUT a trailing DS.
 * dirname — Returns a parent directory's path
 */
define('ROOT', dirname(__DIR__));

/**
 * The full path to the actual working directory directory, WITHOUT a trailing DS.
 * Important if you want use script as commandline utility globally
 * getcwd — Gets the current working directory
 */
define('CLI_ROOT', getcwd());

/**
 * File path to the webroot directory.
 * To use as commandline globally change ROOT to CLI_ROOT.
 */
define('WWW_ROOT', CLI_ROOT . DS . 'webroot' . DS);

/**
 * File path to the config directory.
 */
define('CONFIG', CLI_ROOT . DS . 'config' . DS);

/**
 * Path to config inside phar
 */
//define('CONFIG', 'phar://php-encrypt.phar/config/');
