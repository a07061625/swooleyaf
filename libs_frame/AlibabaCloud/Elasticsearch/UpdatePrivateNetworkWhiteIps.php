<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getModifyMode()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getClientToken()
 */
class UpdatePrivateNetworkWhiteIps extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/private-network-white-ips';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withModifyMode($value)
    {
        $this->data['ModifyMode'] = $value;
        $this->options['query']['modifyMode'] = $value;

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
}
