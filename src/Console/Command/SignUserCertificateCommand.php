<?php
/**
 * SignUserCertificateCommand
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

use Cafe\Gitlab\Blackfriday\Ca\UserCertificateController;
use Cafe\Gitlab\Blackfriday\Model\DomainName;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SignUserCertificateCommand extends Command
{

    /**
     * Basic configuration for Console
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('bf:usersign')
            ->setDescription('Sign user certificate with CA')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Who do you want to greet?'
            )
            ->addOption(
                'CA',
                null,
                InputOption::VALUE_REQUIRED,
                'Certification Authority to Sign with'
            )
            ->addOption(
                'C',
                null,
                InputOption::VALUE_OPTIONAL,
                'Country name: UK'
            )
            ->addOption(
                'S',
                null,
                InputOption::VALUE_OPTIONAL,
                'Province or state name: Sommerset'
            )
            ->addOption(
                'L',
                null,
                InputOption::VALUE_OPTIONAL,
                'Locality Name: Bratislava'
            )
            ->addOption(
                'O',
                null,
                InputOption::VALUE_OPTIONAL,
                'Organization Name: Something l.t.d.'
            )
            ->addOption(
                'ON',
                null,
                InputOption::VALUE_OPTIONAL,
                'Organizationla unit name: Php team support'
            )
            ->addOption(
                'CN',
                null,
                InputOption::VALUE_OPTIONAL,
                'Common Name: Charlotta Jung'
            )
            ->addOption(
                'E',
                null,
                InputOption::VALUE_OPTIONAL,
                'Email: something@somewhere.domain'
            )
            ->addOption(
                'valid',
                null,
                InputOption::VALUE_OPTIONAL,
                'Days for certification validity'
            );
    }

    /**
     * @param InputInterface $input Input intrface
     * @param OutputInterface $output output interface
     * @return void
     *
     * Execute function - run console commands
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cc = new UserCertificateController(new DomainName());
        $cc->domainName->setCountryName($input->getOption('C'));
        $cc->domainName->setStateOrProvinceName($input->getOption('S'));
        $cc->domainName->setLocalityName($input->getOption('L'));
        $cc->domainName->setOrganizationName($input->getOption('O'));
        $cc->domainName->setOrganizationalUnitName($input->getOption('ON'));
        $cc->domainName->setCommonName($input->getOption('CN'));
        $cc->domainName->setEmailAddress($input->getOption('E'));

        $cc->setCertificationAuthority($input->getOption('CA'));

        $cc->setup($input->getOption('CA'));

        $in = $input->getArgument('name');

        print_r($cc->domainName->getDomainName());

        if ($in) {
            $cc->setInternalname($in);
        } else {
            $cc->setInternalname('ca');
        }

        $days = $input->getOption('valid');

        if ($days) {
            $cc->setDaysValid($days);
        }

        $cc->run();
    }
}
