<?php

namespace AlibabaCloud\Codeup;

/**
 * @method string getAccessToken()
 */
class ListOrganizationSecurityScores extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v4/organization/security/scores';

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
