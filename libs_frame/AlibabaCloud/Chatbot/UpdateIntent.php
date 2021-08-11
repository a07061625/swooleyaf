<?php

namespace AlibabaCloud\Chatbot;

/**
 * @method string getIntentDefinition()
 * @method string getIntentId()
 * @method $this withIntentId($value)
 */
class UpdateIntent extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIntentDefinition($value)
    {
        $this->data['IntentDefinition'] = $value;
        $this->options['form_params']['IntentDefinition'] = $value;

        return $this;
    }
}
