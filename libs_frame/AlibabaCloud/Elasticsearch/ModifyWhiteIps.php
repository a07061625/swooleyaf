<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getModifyMode()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getNodeType()
 * @method string getClientToken()
 * @method string getNetworkType()
 */
class ModifyWhiteIps extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/actions/modify-white-ips';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withModifyMode($value)
    {
        $this->data['ModifyMode'] = $value;
        $this->options['form_params']['modifyMode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNodeType($value)
    {
        $this->data['NodeType'] = $value;
        $this->options['form_params']['nodeType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['query']['clientToken'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNetworkType($value)
    {
        $this->data['NetworkType'] = $value;
        $this->options['form_params']['networkType'] = $value;

        return $this;
    }
}
