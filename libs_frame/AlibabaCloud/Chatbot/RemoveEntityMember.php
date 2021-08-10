<?php

namespace AlibabaCloud\Chatbot;

/**
 * @method string getRemoveType()
 * @method $this withRemoveType($value)
 * @method string getMember()
 * @method string getEntityId()
 * @method $this withEntityId($value)
 */
class RemoveEntityMember extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMember($value)
    {
        $this->data['Member'] = $value;
        $this->options['form_params']['Member'] = $value;

        return $this;
    }
}
