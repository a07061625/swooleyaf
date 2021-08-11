<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getTopicId()
 */
class GetTopic extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTopicId($value)
    {
        $this->data['TopicId'] = $value;
        $this->options['form_params']['TopicId'] = $value;

        return $this;
    }
}
