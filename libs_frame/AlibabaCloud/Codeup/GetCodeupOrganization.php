<?php

namespace AlibabaCloud\Codeup;

/**
 * @method string getOrganizationId()
 * @method string getSubUserId()
 * @method string getOrganizationIdentity()
 * @method $this withOrganizationIdentity($value)
 * @method string getAccessToken()
 */
class GetCodeupOrganization extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v4/organization/[OrganizationIdentity]';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOrganizationId($value)
    {
        $this->data['OrganizationId'] = $value;
        $this->options['query']['OrganizationId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSubUserId($value)
    {
        $this->data['SubUserId'] = $value;
        $this->options['query']['SubUserId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccessToken($value)
    {
        $this->data['AccessToken'] = $value;
        $this->options['query']['AccessToken'] = $value;

        return $this;
    }
}
