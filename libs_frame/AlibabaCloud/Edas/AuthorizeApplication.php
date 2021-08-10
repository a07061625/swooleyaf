<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppIds()
 * @method string getTargetUserId()
 */
class AuthorizeApplication extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/account/authorize_app';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppIds($value)
    {
        $this->data['AppIds'] = $value;
        $this->options['query']['AppIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTargetUserId($value)
    {
        $this->data['TargetUserId'] = $value;
        $this->options['query']['TargetUserId'] = $value;

        return $this;
    }
}
