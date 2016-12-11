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
 * Date: 23. 7. 2016
 * Time: 53:57
 *
 * @copyright     Copyright (c) May Meow
 * @copyright     Copyright (c) GitlabCafe community
 * @link          https://github.com/jdmaymeow May Meow
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

require_once './config/app.php';
require_once './vendor/autoload.php';

$cert = file_get_contents(WWW_ROOT . 'server' . DS . 'certificate.crt');
$key = file_get_contents(WWW_ROOT . 'server' . DS . 'certificate.key');

$resuld = openssl_x509_check_private_key($cert, $key);
var_dump($resuld);
