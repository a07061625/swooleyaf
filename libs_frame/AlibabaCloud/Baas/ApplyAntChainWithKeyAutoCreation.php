<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getOrganizationUnitName()
 * @method string getPassword()
 * @method string getLocalityName()
 * @method string getStateOrProvinceName()
 * @method string getCommonName()
 * @method string getOrganizationName()
 * @method string getBizid()
 * @method string getCountryName()
 * @method string getConsortiumId()
 */
class ApplyAntChainWithKeyAutoCreation extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrganizationUnitName($value)
    {
        $this->data['OrganizationUnitName'] = $value;
        $this->options['form_params']['OrganizationUnitName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPassword($value)
    {
        $this->data['Password'] = $value;
        $this->options['form_params']['Password'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLocalityName($value)
    {
        $this->data['LocalityName'] = $value;
        $this->options['form_params']['LocalityName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStateOrProvinceName($value)
    {
        $this->data['StateOrProvinceName'] = $value;
        $this->options['form_params']['StateOrProvinceName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCommonName($value)
    {
        $this->data['CommonName'] = $value;
        $this->options['form_params']['CommonName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrganizationName($value)
    {
        $this->data['OrganizationName'] = $value;
        $this->options['form_params']['OrganizationName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizid($value)
    {
        $this->data['Bizid'] = $value;
        $this->options['form_params']['Bizid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCountryName($value)
    {
        $this->data['CountryName'] = $value;
        $this->options['form_params']['CountryName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConsortiumId($value)
    {
        $this->data['ConsortiumId'] = $value;
        $this->options['form_params']['ConsortiumId'] = $value;

        return $this;
    }
}
