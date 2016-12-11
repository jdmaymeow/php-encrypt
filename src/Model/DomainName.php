<?php
/**
 * DomainName
 *
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * User: May
 * Date: 18. 7. 2016
 * Time: 21:26
 *
 * @copyright     Copyright (c) May Meow
 * @copyright     Copyright (c) GitlabCafe community
 * @link          https://github.com/jdmaymeow May Meow
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace Cafe\Gitlab\Blackfriday\Model;

class DomainName
{
    private $countryName;
    private $stateOrProvinceName;
    private $localityName;
    private $organizationName;
    private $organizationalUnitName;
    private $commonName;
    private $emailAddress;

    /**
     * @return mixed CountryName
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * @param mixed $countryName Country Name
     * @return void
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;
    }

    /**
     * @return mixed
     */
    public function getStateOrProvinceName()
    {
        return $this->stateOrProvinceName;
    }

    /**
     * @param mixed $stateOrProvinceName State or Province name
     * @return void
     */
    public function setStateOrProvinceName($stateOrProvinceName)
    {
        $this->stateOrProvinceName = $stateOrProvinceName;
    }

    /**
     * @return mixed
     */
    public function getLocalityName()
    {
        return $this->localityName;
    }

    /**
     * @param mixed $localityName Locality Name
     * @return void
     */
    public function setLocalityName($localityName)
    {
        $this->localityName = $localityName;
    }

    /**
     * @return mixed
     */
    public function getOrganizationName()
    {
        return $this->organizationName;
    }

    /**
     * @param mixed $organizationName Organization Name
     * @return void
     */
    public function setOrganizationName($organizationName)
    {
        $this->organizationName = $organizationName;
    }

    /**
     * @return mixed
     */
    public function getOrganizationalUnitName()
    {
        return $this->organizationalUnitName;
    }

    /**
     * @param mixed $organizationalUnitName O
     * @return void
     */
    public function setOrganizationalUnitName($organizationalUnitName)
    {
        $this->organizationalUnitName = $organizationalUnitName;
    }

    /**
     * @return mixed CommonName
     */
    public function getCommonName()
    {
        return $this->commonName;
    }

    /**
     * @param mixed $commonName CN
     * @return void
     */
    public function setCommonName($commonName)
    {
        $this->commonName = $commonName;
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param mixed $emailAddress Email address
     * @return void
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return array Returns domain name
     */
    public function getDomainName()
    {
        if (!is_null($this->countryName)) {
            $dn['countryName'] = $this->countryName;
        }

        if (!is_null($this->stateOrProvinceName)) {
            $dn['stateOrProvinceName'] = $this->stateOrProvinceName;
        }

        if (!is_null($this->localityName)) {
            $dn['localityName'] = $this->localityName;
        }

        if (!is_null($this->organizationName)) {
            $dn['organizationName'] = $this->organizationName;
        }

        if (!is_null($this->organizationalUnitName)) {
            $dn['organizationalUnitName'] = $this->organizationalUnitName;
        }

        if (!is_null($this->commonName)) {
            $dn['commonName'] = $this->commonName;
        }

        if (!is_null($this->emailAddress)) {
            $dn['emailAddress'] = $this->emailAddress;
        }


        return $dn;
    }
}
