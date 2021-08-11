<?php

namespace AlibabaCloud\Codeup;

/**
 * @method string getAccessToken()
 */
class CreateSshKey extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v3/user/keys';

    /** @var string */
    public $method = 'POST';

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
