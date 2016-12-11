<?php
 /**
  * EncryptCaKeyHelper
  *
  *
  * Licensed under The MIT License
  * For full copyright and license information, please see the LICENSE
  * Redistributions of files must retain the above copyright notice.
  *
  * User: May
  * Date: 20. 7. 2016
  * Time: 14:58
  *
  * @copyright     Copyright (c) May Meow
  * @copyright     Copyright (c) GitlabCafe community
  * @link          https://github.com/jdmaymeow May Meow
  * @since         1.0
  * @license       http://www.opensource.org/licenses/mit-license.php MIT License
  */

namespace Cafe\Gitlab\Blackfriday\Utils;

use Cafe\Gitlab\Blackfriday\Ca\MainController;

class EncryptCaKeyHelper extends MainController
{
    private $ca_config;
    private $ica_config;
    private $CaKeyPath;
    private $IntermediateCaKeyPath;

    /**
     * Function run
     * @return void
     */
    public function run()
    {
        $this->ca_config = [
            'config' => CONFIG . 'ca.cnf',
            'x509_extensions' => $this->defaultConfig['certificates']['server']['x509_extensions'],
            'private_key_bits' => $this->defaultConfig['default']['private_key_bits']
        ];

        $this->ica_config = [
            'config' => CONFIG . 'intermediate.cnf',
            'x509_extensions' => $this->defaultConfig['certificates']['server']['x509_extensions'],
            'private_key_bits' => $this->defaultConfig['default']['private_key_bits']
        ];

        $this->CaKeyPath = WWW_ROOT . $this->internalname . DS . 'ca.key';
        $this->IntermediateCaKeyPath = WWW_ROOT . $this->internalname . DS . 'intermediate.key';

        $this->_backupKeys();

        $this->_encryptKeys();
    }

    /**
     * Function _encrypt keys
     * @return void
     */
    protected function _encryptKeys()
    {
        $cakey = file_get_contents($this->CaKeyPath);
        $icakey = file_get_contents($this->IntermediateCaKeyPath);

        openssl_pkey_export_to_file($cakey, WWW_ROOT . $this->internalname . DS . 'ca.key', $this->defaultConfig['default']['ca_key_cipher'], $this->ca_config);
        openssl_pkey_export_to_file($icakey, WWW_ROOT . $this->internalname . DS . 'intermediate.key', $this->defaultConfig['default']['ica_key_cipher'], $this->ica_config);
    }

    /**
     * Function _backupKeys
     * @return void
     */
    protected function _backupKeys()
    {
        copy($this->CaKeyPath, $this->CaKeyPath . '.' . time() . '.backup');
        copy($this->IntermediateCaKeyPath, $this->IntermediateCaKeyPath . '.' . time() . '.backup');
    }
}
