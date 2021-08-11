<?php

namespace AlibabaCloud\Codeup;

/**
 * @method string getAccessToken()
 */
class GetOrganizationSecurityCenterStatus extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v4/organization/security/status';

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
