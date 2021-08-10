<?php

namespace AlibabaCloud\Chatbot;

/**
 * @method string getRegex()
 * @method $this withRegex($value)
 * @method string getEntityType()
 * @method $this withEntityType($value)
 * @method string getMembers()
 * @method string getEntityName()
 * @method $this withEntityName($value)
 * @method string getDialogId()
 * @method $this withDialogId($value)
 */
class CreateEntity extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMembers($value)
    {
        $this->data['Members'] = $value;
        $this->options['form_params']['Members'] = $value;

        return $this;
    }
}
