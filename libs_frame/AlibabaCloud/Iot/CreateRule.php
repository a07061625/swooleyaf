<?php

namespace AlibabaCloud\Iot;

/**
 * @method string getSelect()
 * @method $this withSelect($value)
 * @method string getRuleDesc()
 * @method $this withRuleDesc($value)
 * @method string getShortTopic()
 * @method $this withShortTopic($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDataType()
 * @method $this withDataType($value)
 * @method string getIotInstanceId()
 * @method $this withIotInstanceId($value)
 * @method string getWhere()
 * @method $this withWhere($value)
 * @method string getTopicType()
 * @method $this withTopicType($value)
 * @method string getProductKey()
 * @method $this withProductKey($value)
 * @method string getApiProduct()
 * @method string getName()
 * @method $this withName($value)
 * @method string getTopic()
 * @method $this withTopic($value)
 * @method string getApiRevision()
 */
class CreateRule extends Rpc
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
