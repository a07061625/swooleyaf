<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAct()
 * @method string getAppId()
 */
class DeleteServerlessApplication extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/k8s/pop/pop_serverless_app_delete';

    /** @var string */
    public $method = 'DELETE';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAct($value)
    {
        $this->data['Act'] = $value;
        $this->options['query']['Act'] = $value;

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
