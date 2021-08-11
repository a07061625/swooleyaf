<?php

namespace AlibabaCloud\Chatbot;

/**
 * @method string getKnowledge()
 */
class CreateKnowledge extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withKnowledge($value)
    {
        $this->data['Knowledge'] = $value;
        $this->options['form_params']['Knowledge'] = $value;

        return $this;
    }
}
