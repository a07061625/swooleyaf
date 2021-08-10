<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getEcuInfo()
 * @method string getDeployGroup()
 * @method string getAppId()
 */
class ScaleOutApplication extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/changeorder/co_scale_out';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEcuInfo($value)
    {
        $this->data['EcuInfo'] = $value;
        $this->options['query']['EcuInfo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeployGroup($value)
    {
        $this->data['DeployGroup'] = $value;
        $this->options['query']['DeployGroup'] = $value;

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
