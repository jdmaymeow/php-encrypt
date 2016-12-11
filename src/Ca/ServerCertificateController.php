<?php
/**
 * ServerCertificateController
 *
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * User: May
 * Date: 18. 7. 2016
 * Time: 22:34
 *
 * @copyright     Copyright (c) May Meow
 * @copyright     Copyright (c) GitlabCafe community
 * @link          https://github.com/jdmaymeow May Meow
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace Cafe\Gitlab\Blackfriday\Ca;

class ServerCertificateController extends MainController
{

    private $SignedCertificatePath;

    /**
     * @param string $CertificationAuthority Certification authority name
     * @return void
     */
    public function setup($CertificationAuthority)
    {
        $this->CaCertificatePath = file_get_contents(WWW_ROOT . $this->CertificationAuthority . DS . 'intermediate.crt');
        $this->CaCertificateKeyPath = [
            file_get_contents(WWW_ROOT . $this->CertificationAuthority . DS . 'intermediate.key'),
            $this->defaultConfig['default']['ica_key_cipher']
        ];
        $this->CaChainPath = file_get_contents(WWW_ROOT . $this->CertificationAuthority . DS . 'cachain.pem');

        $this->daysValid = $this->defaultConfig['certificates']['server']['daysvalid'];
    }

    /**
     * Function run
     * @return void
     */
    public function run()
    {
        $this->config = [
            'config' => CONFIG . 'intermediate.cnf',
            'x509_extensions' => $this->defaultConfig['certificates']['server']['x509_extensions'],
            'private_key_bits' => $this->defaultConfig['default']['private_key_bits']
        ];

        print_r($this->config);

        $internalName = $this->internalname;

        if (!file_exists(WWW_ROOT . $internalName)) {
            mkdir(WWW_ROOT . $internalName, 0777, true);
        }

        $this->sign();

        $this->SignedCertificatePath = file_get_contents(WWW_ROOT . $this->internalname . DS . 'certificate.crt');

        $this->createFullChain($this->CaChainPath, $this->SignedCertificatePath);
    }

    /**
     * Function Sign
     * @return void
     */
    protected function sign()
    {
        $privkey = openssl_pkey_new($this->config);
        $csr = openssl_csr_new($this->domainName->getDomainName(), $privkey, $this->config);
        $signedcert = openssl_csr_sign($csr, $this->CaCertificatePath, $this->CaCertificateKeyPath, $this->daysValid, $this->config, time());

        openssl_x509_export_to_file($signedcert, WWW_ROOT . $this->internalname . DS . 'certificate.crt');
        openssl_pkey_export_to_file($privkey, WWW_ROOT . $this->internalname . DS . 'certificate.key', null, $this->config);

        openssl_pkcs12_export_to_file($signedcert, WWW_ROOT . $this->internalname . DS . 'certificate.pfx', $privkey, 1111, $this->config);
    }
}
