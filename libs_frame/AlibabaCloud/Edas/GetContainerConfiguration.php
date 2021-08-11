<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppId()
 * @method string getGroupId()
 */
class GetContainerConfiguration extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/app/container_config';

    /** @var string */
    public $method = 'GET';

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
    public function withGroupId($value)
    {
        $this->data['GroupId'] = $value;
        $this->options['query']['GroupId'] = $value;

        return $this;
    }
}
