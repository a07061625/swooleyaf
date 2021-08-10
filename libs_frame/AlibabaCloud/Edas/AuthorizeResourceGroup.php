<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getResourceGroupIds()
 * @method string getTargetUserId()
 */
class AuthorizeResourceGroup extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/account/authorize_res_group';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withResourceGroupIds($value)
    {
        $this->data['ResourceGroupIds'] = $value;
        $this->options['query']['ResourceGroupIds'] = $value;

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
