<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getReplicas()
 * @method string getAppId()
 */
class ScaleServerlessApplication extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/k8s/pop/pop_serverless_app_rescale';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withReplicas($value)
    {
        $this->data['Replicas'] = $value;
        $this->options['query']['Replicas'] = $value;

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
