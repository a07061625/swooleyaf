<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getRealTenantId()
 * @method $this withRealTenantId($value)
 * @method string getOtaEventFlag()
 * @method $this withOtaEventFlag($value)
 * @method string getDeviceTopoLifeCycleFlag()
 * @method $this withDeviceTopoLifeCycleFlag($value)
 * @method string getDeviceLifeCycleFlag()
 * @method $this withDeviceLifeCycleFlag($value)
 * @method string getType()
 * @method $this withType($value)
 * @method string getRealTripartiteKey()
 * @method $this withRealTripartiteKey($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getDeviceStatusChangeFlag()
 * @method $this withDeviceStatusChangeFlag($value)
 * @method string getOtaVersionFlag()
 * @method $this withOtaVersionFlag($value)
 * @method string getDeviceTagFlag()
 * @method $this withDeviceTagFlag($value)
 * @method array getConsumerGroupIds()
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getThingHistoryFlag()
 * @method $this withThingHistoryFlag($value)
 * @method string getFoundDeviceListFlag()
 * @method $this withFoundDeviceListFlag($value)
 * @method string getOtaJobFlag()
 * @method $this withOtaJobFlag($value)
 * @method string getApiProduct()
 * @method string getDeviceDataFlag()
 * @method $this withDeviceDataFlag($value)
 * @method string getApiRevision()
 * @method string getMnsConfiguration()
 * @method $this withMnsConfiguration($value)
 */
class CreateSubscribeRelation extends Rpc
{
    /**
     * @return $this
     */
    public function withConsumerGroupIds(array $consumerGroupIds)
    {
        $this->data['ConsumerGroupIds'] = $consumerGroupIds;
        foreach ($consumerGroupIds as $i => $iValue) {
            $this->options['query']['ConsumerGroupIds.' . ($i + 1)] = $iValue;
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
