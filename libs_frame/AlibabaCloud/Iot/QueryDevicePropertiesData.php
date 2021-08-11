<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getRealTenantId()
 * @method $this withRealTenantId($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getRealTripartiteKey()
 * @method $this withRealTripartiteKey($value)
 * @method string getIotId()
 * @method $this withIotId($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method array getIdentifier()
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getAsc()
 * @method $this withAsc($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 * @method string getDeviceName()
 * @method $this withDeviceName($value)
 */
class QueryDevicePropertiesData extends Rpc
{
    /**
     * @return $this
     */
    public function withIdentifier(array $identifier)
    {
        $this->data['Identifier'] = $identifier;
        foreach ($identifier as $i => $iValue) {
            $this->options['query']['Identifier.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiProduct($value)
    {
        $this->data['ApiProduct'] = $value;
        $this->options['form_params']['ApiProduct'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withApiRevision($value)
    {
        $this->data['ApiRevision'] = $value;
        $this->options['form_params']['ApiRevision'] = $value;

        return $this;
    }
}
