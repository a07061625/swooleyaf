<?php

namespace AlibabaCloud\Chatbot;

/**
 * @method string getModuleDefinition()
 * @method string getDialogId()
 * @method $this withDialogId($value)
 */
class UpdateDialogFlow extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withModuleDefinition($value)
    {
        $this->data['ModuleDefinition'] = $value;
        $this->options['form_params']['ModuleDefinition'] = $value;

        return $this;
    }
}
