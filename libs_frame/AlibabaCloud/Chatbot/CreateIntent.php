<?php

namespace AlibabaCloud\Chatbot;

/**
 * @method string getIntentDefinition()
 * @method string getDialogId()
 * @method $this withDialogId($value)
 */
class CreateIntent extends Rpc
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
