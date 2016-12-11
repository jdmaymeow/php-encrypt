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
 * Date: 19. 7. 2016
 * Time: 14:38
 *
 * @copyright     Copyright (c) May Meow
 * @copyright     Copyright (c) GitlabCafe community
 * @link          https://github.com/jdmaymeow May Meow
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace tests;

use Symfony\Component\Yaml\Yaml;

require_once './config/app.php';
require_once './vendor/autoload.php';

$configfile = file_get_contents(CONFIG . 'encrypt.yml');

$config = Yaml::parse($configfile);

echo $config['certificates']['ca']['daysvalid'];
