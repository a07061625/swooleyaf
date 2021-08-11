<?php

namespace AlibabaCloud\Dts;

/**
 * @method string getConsumerGroupName()
 * @method $this withConsumerGroupName($value)
 * @method string getConsumerGroupID()
 * @method $this withConsumerGroupID($value)
 * @method string getSubscriptionInstanceId()
 * @method $this withSubscriptionInstanceId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getConsumerGroupNewPassword()
 * @method string getConsumerGroupPassword()
 * @method $this withConsumerGroupPassword($value)
 * @method string getAccountId()
 * @method $this withAccountId($value)
 * @method string getConsumerGroupUserName()
 * @method $this withConsumerGroupUserName($value)
 */
class ModifyConsumerGroupPassword extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConsumerGroupNewPassword($value)
    {
        $this->data['ConsumerGroupNewPassword'] = $value;
        $this->options['query']['consumerGroupNewPassword'] = $value;

        return $this;
    }
}
