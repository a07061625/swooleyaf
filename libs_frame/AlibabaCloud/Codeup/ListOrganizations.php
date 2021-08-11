<?php

namespace AlibabaCloud\Codeup;

/**
 * @method string getAccessLevel()
 * @method string getMinAccessLevel()
 * @method string getAccessToken()
 */
class ListOrganizations extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v4/organization';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccessLevel($value)
    {
        $this->data['AccessLevel'] = $value;
        $this->options['query']['AccessLevel'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMinAccessLevel($value)
    {
        $this->data['MinAccessLevel'] = $value;
        $this->options['query']['MinAccessLevel'] = $value;

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
