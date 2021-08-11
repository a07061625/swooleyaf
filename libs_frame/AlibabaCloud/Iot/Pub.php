<?php

namespace AlibabaCloud\Iot;

/**
 * @method array getUserProp()
 * @method string getMessageContent()
 * @method $this withMessageContent($value)
 * @method string getQos()
 * @method $this withQos($value)
 * @method string getCorrelationData()
 * @method $this withCorrelationData($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getResponseTopic()
 * @method $this withResponseTopic($value)
 * @method string getTopicFullName()
 * @method $this withTopicFullName($value)
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getApiProduct()
 * @method string getApiRevision()
 */
class Pub extends Rpc
{
    /**
     * @return $this
     */
    public function withUserProp(array $userProp)
    {
        $this->data['UserProp'] = $userProp;
        foreach ($userProp as $depth1 => $depth1Value) {
            if (isset($depth1Value['Value'])) {
                $this->options['query']['UserProp.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
            if (isset($depth1Value['Key'])) {
                $this->options['query']['UserProp.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
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
