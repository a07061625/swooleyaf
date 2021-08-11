<?php

namespace AlibabaCloud\Idrsservice;

/**
 * @method string getMqInstanceId()
 * @method $this withMqInstanceId($value)
 * @method string getMqGroupId()
 * @method $this withMqGroupId($value)
 * @method array getMqEvent()
 * @method string getMqEndpoint()
 * @method $this withMqEndpoint($value)
 * @method string getMqTopic()
 * @method $this withMqTopic($value)
 * @method string getMqSubscribe()
 * @method $this withMqSubscribe($value)
 */
class UpdateSlrConfiguration extends Rpc
{
    /**
     * @return $this
     */
    public function withMqEvent(array $mqEvent)
    {
        $this->data['MqEvent'] = $mqEvent;
        foreach ($mqEvent as $i => $iValue) {
            $this->options['query']['MqEvent.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
