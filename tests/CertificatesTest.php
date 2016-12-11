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
 * Date: 26. 7. 2016
 * Time: 11:40
 *
 * @copyright     Copyright (c) May Meow
 * @copyright     Copyright (c) GitlabCafe community
 * @link          https://github.com/jdmaymeow May Meow
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace tests;

require_once dirname(__DIR__) . '/config/app.php';

require_once ROOT . DS . 'vendor/autoload.php';


class CertificatesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Function testCaCertificate
     * @return void
     */
    public function testCaCertificate()
    {
        $cert = openssl_x509_parse(file_get_contents(WWW_ROOT . 'TestCA' . DS . 'ca.crt'));

        $this->assertEquals('/C=SK/O=TEST ltd./CN=TEST CA', $cert['name']);
    }

    /**
     * Function testIntermediateCertificate
     * @return void
     */
    public function testIntermediateCertificate()
    {
        $cert = openssl_x509_parse(file_get_contents(WWW_ROOT . 'TestCA' . DS . 'intermediate.crt'));

        $this->assertEquals('/C=SK/O=TEST ltd./CN=TEST Intermediate CA', $cert['name']);
    }

    /**
     * Function testUserCertificate
     * @return void
     */
    public function testUserCertificate()
    {
        $cert = openssl_x509_parse(file_get_contents(WWW_ROOT . 'user' . DS . 'certificate.crt'));

        $this->assertEquals('/C=SK/CN=Jane Doe/emailAddress=jane@doe.local', $cert['name']);
    }

    /**
     * Function testServerCertificate
     * @return void
     */
    public function testServerCertificate()
    {
        $cert = openssl_x509_parse(file_get_contents(WWW_ROOT . 'server' . DS . 'certificate.crt'));

        $this->assertEquals('/C=SK/CN=www.domain.tld', $cert['name']);
    }

    /**
     * Function testJohnCertificates
     * @return void
     */
    public function testJohnCertificates()
    {
        $JohnDoe = openssl_x509_parse(file_get_contents(WWW_ROOT . 'john-doe' . DS . 'certificate.crt'));

        $this->assertEquals('/C=SK/ST=Zapad/L=Bratislava/O=Test LTD./OU=Test user/CN=John Doe/emailAddress=John@doe.local', $JohnDoe['name']);
    }

    /**
     * Function testJaneCertificates
     * @return void
     */
    public function testJaneCertificates()
    {
        $JaneDoe = openssl_x509_parse(file_get_contents(WWW_ROOT . 'jane-doe' . DS . 'certificate.crt'));

        $this->assertEquals('/C=SK/ST=Vychod/L=Kosice/O=Test LTD./OU=Test User/CN=Jane Doe/emailAddress=jane@doe.sk', $JaneDoe['name']);
    }
}
