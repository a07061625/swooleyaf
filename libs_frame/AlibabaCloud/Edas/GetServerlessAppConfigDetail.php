<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppId()
 */
class GetServerlessAppConfigDetail extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/k8s/pop/pop_serverless_app_config_detail';

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
}
