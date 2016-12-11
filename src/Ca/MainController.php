<?php
/**
 * MainController
 *
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * User: May
 * Date: 18. 7. 2016
 * Time: 21:35
 *
 * @copyright     Copyright (c) May Meow
 * @copyright     Copyright (c) GitlabCafe community
 * @link          https://github.com/jdmaymeow May Meow
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace Cafe\Gitlab\Blackfriday\Ca;

use Cafe\Gitlab\Blackfriday\Model\DomainName;
use Symfony\Component\Yaml\Yaml;

class MainController
{

    public $domainName;

    protected $internalname;

    /**
     * @var
     */
    protected $config;

    protected $daysValid;

    protected $defaultConfig;

    protected $CaCertificatePath;

    protected $CaCertificateKeyPath;

    protected $CaChainPath;

    protected $CertificationAuthority;

    /**
     * MainController constructor.
     * @param DomainName $domainName Domain name configuration
     */
    public function __construct(DomainName $domainName)
    {
        $this->domainName = $domainName;
        $this->setDefaultConfig();
    }

    /**
     * Function setDefaultConfig
     * @return void
     */
    public function setDefaultConfig()
    {
        $configFile = file_get_contents(CONFIG . 'encrypt.yml');
        $defaultConfig = Yaml::parse($configFile);
        $this->defaultConfig = $defaultConfig;
    }

    /**
     * @return mixed
     */
    public function getInternalname()
    {
        return $this->internalname;
    }

    /**
     * @param mixed $internalname Internal name of certificate
     * @return void
     */
    public function setInternalname($internalname)
    {
        $this->internalname = $internalname;
    }

    /**
     * Fucntion to set days fr\or validity
     * @param int $daysValid days
     * @return void
     */
    public function setDaysValid($daysValid) {
        $this->daysValid = $daysValid;
    }

    /**
     * @param string $CaChainPath Path to Ca Certification chain
     * @param string $SignedCertificatePath Path to signed certificate
     * @return void
     */
    protected function createFullChain($CaChainPath, $SignedCertificatePath)
    {
        //$CaChain = file_get_contents($CaChainPath);
        //$SignedCertificate = file_get_contents($SignedCertificatePath);

        $FullChain = $SignedCertificatePath . $CaChainPath;

        file_put_contents(WWW_ROOT . $this->internalname . DS . 'fullchain.pem', $FullChain);
    }

    /**
     * @param string $CaCert Ca certificate
     * @param string $IcaCert Intermediate CA certificate
     * @return void
     */
    protected function createCaChain($CaCert, $IcaCert)
    {
        //do not use this anymore after version 0.6.5
        //$CaCert = file_get_contents($CaCert);
        //$IcaCert = file_get_contents($IcaCert);
        $CaChain = $IcaCert . $CaCert;
        file_put_contents(WWW_ROOT . $this->internalname . DS . 'cachain.pem', $CaChain);
    }

    /**
     * @return mixed
     */
    public function getCertificationAuthority()
    {
        return $this->CertificationAuthority;
    }

    /**
     * @param string $CertificationAuthority Certification authority name
     * @return void
     */
    public function setCertificationAuthority($CertificationAuthority)
    {
        $this->CertificationAuthority = $CertificationAuthority;
    }
}
