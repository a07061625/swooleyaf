<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getAppId()
 * @method string getSecurityGroupId()
 */
class UpdateAppSecurityGroup extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/app/updateAppSecurityGroup';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['query']['AppId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSecurityGroupId($value)
    {
        $this->data['SecurityGroupId'] = $value;
        $this->options['query']['SecurityGroupId'] = $value;

        return $this;
    }
}
