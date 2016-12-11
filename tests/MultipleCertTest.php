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
 * Date: 25. 7. 2016
 * Time: 20:34
 *
 * @copyright     Copyright (c) May Meow
 * @copyright     Copyright (c) GitlabCafe community
 * @link          https://github.com/jdmaymeow May Meow
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace tests;

use Cafe\Gitlab\Blackfriday\Ca\UserCertificateController;
use Cafe\Gitlab\Blackfriday\Model\DomainName;
use Cafe\Gitlab\Blackfriday\Utils\JsonHelper;

require_once './config/app.php';
require_once './vendor/autoload.php';

$jh = new JsonHelper();

$config = $jh->decode('certificates');

$cc = new UserCertificateController(new DomainName());


foreach ($config->certificates as $certificate) {
    $cc->domainName->setCountryName($certificate->countryName);
    $cc->domainName->setStateOrProvinceName($certificate->stateOrProvinceName);
    $cc->domainName->setLocalityName($certificate->localityName);
    $cc->domainName->setOrganizationName($certificate->organizationName);
    $cc->domainName->setOrganizationalUnitName($certificate->organizationalUnitName);
    $cc->domainName->setCommonName($certificate->commonName);
    $cc->domainName->setEmailAddress($certificate->emailAddress);

    $cc->setCertificationAuthority('CharlotteEncrypt');

    $cc->setup('CharlotteEncrypt');

    $in = $certificate->internalName;

    var_dump($cc->domainName->getDomainName());

    if ($in) {
        $cc->setInternalname($in);
    } else {
        $cc->setInternalname('ca');
    }
    $cc->run();
}
