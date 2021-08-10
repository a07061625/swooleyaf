<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getInstanceIds()
 * @method string getAppId()
 */
class RestartInstances extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/app/restartInstances';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceIds($value)
    {
        $this->data['InstanceIds'] = $value;
        $this->options['query']['InstanceIds'] = $value;

        return $this;
    }

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
}
