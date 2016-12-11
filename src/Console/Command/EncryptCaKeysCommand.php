<?php
 /**
  * EncryptCaKeysCommand
  *
  *
  * Licensed under The MIT License
  * For full copyright and license information, please see the LICENSE
  * Redistributions of files must retain the above copyright notice.
  *
  * User: May
  * Date: 18. 7. 2016
  * Time: 21:21
  *
  * @copyright     Copyright (c) May Meow
  * @copyright     Copyright (c) GitlabCafe community
  * @link          https://github.com/jdmaymeow May Meow
  * @since         1.0
  * @license       http://www.opensource.org/licenses/mit-license.php MIT License
  */

namespace Cafe\Gitlab\Blackfriday\Console\Command;

use Cafe\Gitlab\Blackfriday\Model\DomainName;
use Cafe\Gitlab\Blackfriday\Utils\EncryptCaKeyHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class EncryptCaKeysCommand extends Command
{

    /**
     * Basic console configuration
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('bf:ca:encrypt')
            ->setDescription('Encrypt CA and Intermediate CA keys')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Who do you want to greet?'
            );
    }

    /**
     * @param InputInterface $input Input interface
     * @param OutputInterface $output Output interface
     * @return void
     *
     * Execute function - run console commands
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cc = new EncryptCaKeyHelper(new DomainName());
        $Ca = $input->getArgument('name');

        $cc->setInternalname($Ca);

        $cc->run();
    }
}
