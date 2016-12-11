<?php
/**
 * Index
 *
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * User: May
 * Date: 28. 7. 2016
 * Time: 21:24
 *
 * @copyright     Copyright (c) May Meow
 * @copyright     Copyright (c) GitlabCafe community
 * @link          https://github.com/jdmaymeow May Meow
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace CA;

use Cafe\Gitlab\Blackfriday\Console\Command\CreateCaCommand;
use Cafe\Gitlab\Blackfriday\Console\Command\EncryptCaKeysCommand;
use Cafe\Gitlab\Blackfriday\Console\Command\SignIntermediateCertificateCommand;
use Cafe\Gitlab\Blackfriday\Console\Command\SignServerCertificateCommand;
use Cafe\Gitlab\Blackfriday\Console\Command\SignUserCertificateCommand;
use Symfony\Component\Console\Application;

require_once 'config/app.php';

require_once 'vendor/autoload.php';

$app = new Application('PHP Encrypt 0.6.2 CE beta');
$app->add(new CreateCaCommand());
$app->add(new SignUserCertificateCommand());
$app->add(new SignIntermediateCertificateCommand());
$app->add(new SignServerCertificateCommand());
$app->add(new EncryptCaKeysCommand());
$app->run();
