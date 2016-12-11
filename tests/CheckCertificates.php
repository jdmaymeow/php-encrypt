<?php
/**
 * CertificatesTest
 *
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * User: May
 * Date: 22. 7. 2016
 * Time: 21:05
 *
 * @copyright     Copyright (c) May Meow
 * @copyright     Copyright (c) GitlabCafe community
 * @link          https://github.com/jdmaymeow May Meow
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

require_once './config/app.php';
require_once './vendor/autoload.php';

$cert = openssl_x509_parse(file_get_contents(WWW_ROOT . 'myca' . DS . 'ca.crt'));

var_dump($cert['name']);
