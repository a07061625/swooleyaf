<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getSourceData()
 * @method $this withSourceData($value)
 * @method string getTargetType()
 * @method $this withTargetType($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getSourceType()
 * @method $this withSourceType($value)
 * @method string getTopicFilter()
 * @method $this withTopicFilter($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getTargetData()
 * @method $this withTargetData($value)
 * @method string getApiProduct()
 * @method string getName()
 * @method $this withName($value)
 * @method string getApiRevision()
 * @method string getTargetIotHubQos()
 * @method $this withTargetIotHubQos($value)
 */
class CreateEdgeInstanceMessageRouting extends Rpc
{
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
