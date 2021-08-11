<?php

namespace AlibabaCloud\MPServerless;

/**
 * @method string getExtensionId()
 */
class EnableExtension extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtensionId($value)
    {
        $this->data['ExtensionId'] = $value;
        $this->options['form_params']['ExtensionId'] = $value;

        return $this;
    }
}
