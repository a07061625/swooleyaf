<?php

namespace AlibabaCloud\Chatbot;

/**
 * @method string getMember()
 * @method string getEntityId()
 * @method $this withEntityId($value)
 * @method string getApplyType()
 * @method $this withApplyType($value)
 */
class AppendEntityMember extends Rpc
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
