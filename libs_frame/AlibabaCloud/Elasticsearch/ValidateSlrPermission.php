<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getClientToken()
 * @method string getRolename()
 */
class ValidateSlrPermission extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/user/servicerolepermission';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['query']['ClientToken'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRolename($value)
    {
        $this->data['Rolename'] = $value;
        $this->options['query']['rolename'] = $value;

        return $this;
    }
}
