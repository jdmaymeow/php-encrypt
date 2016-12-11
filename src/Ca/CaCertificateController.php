<?php
/**
 * CaCertificateController
 *
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * User: May
 * Date: 18. 7. 2016
 * Time: 21:36
 *
 * @copyright     Copyright (c) May Meow
 * @copyright     Copyright (c) GitlabCafe community
 * @link          https://github.com/jdmaymeow May Meow
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Cafe\Gitlab\Blackfriday\Ca;

class CaCertificateController extends MainController
{

    /**
     * Function run
     * @return void
     */
    public function run()
    {
        $this->config = [
            'config' => CONFIG . 'ca.cnf',
            'x509_extensions' => $this->defaultConfig['certificates']['ca']['x509_extensions'],
            'private_key_bits' => $this->defaultConfig['default']['private_key_bits']
        ];

        $this->daysValid = $this->defaultConfig['certificates']['ca']['daysvalid'];

        $dn = $this->domainName->getDomainName();

        $internalName = $this->internalname;

        if (!file_exists(WWW_ROOT . $internalName)) {
            mkdir(WWW_ROOT . $internalName, 0777, true);
        }

        print_r($this->config);

        $this->sign();
    }

    /**
     * Function Sign
     * @return void
     */
    protected function sign()
    {
        $privkey = openssl_pkey_new($this->config);
        $csr = openssl_csr_new($this->domainName->getDomainName(), $privkey, $this->config);
        $signedcert = openssl_csr_sign($csr, null, $privkey, $this->daysValid, $this->config, time());

        openssl_x509_export_to_file($signedcert, WWW_ROOT . $this->internalname . DS . 'ca.crt');
        openssl_pkey_export_to_file($privkey, WWW_ROOT . $this->internalname . DS . 'ca.key', $this->defaultConfig['default']['ca_key_cipher'], $this->config);
    }
}
