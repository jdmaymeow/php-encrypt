<?php
/**
 * Create Phar
 *
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * User: May
 * Date: 22. 7. 2016
 * Time: 19:58
 *
 * @copyright     Copyright (c) May Meow
 * @copyright     Copyright (c) GitlabCafe community
 * @link          https://github.com/jdmaymeow May Meow
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$srcRoot = __DIR__;
$buildRoot = "build";

/*
 * PHP Phar - How to create and use a Phar archive
 */

$p = new Phar('build/php-encrypt.phar', FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME, 'php-encrypt.phar');
//issue the Phar::startBuffering() method call to buffer changes made to the archive until you issue the Phar::stopBuffering() command
$p->startBuffering();

//set the Phar file stub
//the file stub is merely a small segment of code that gets run initially when the Phar file is loaded,
//and it always ends with a __HALT_COMPILER()
$p->setStub('<?php Phar::mapPhar(); include "phar://php-encrypt.phar/index.php"; __HALT_COMPILER(); ?>');

//Adding files to the archive
$p['text.txt'] = 'This is a text file';
//Adding files to an archive using Phar::buildFromDirectory()
//adds all of the PHP files in the stated directory to the Phar archive
$p->buildFromDirectory($srcRoot);

//Stop buffering write requests to the Phar archive, and save changes to disk
$p->stopBuffering();
echo "my.phar archive has been saved";
