<?php

namespace AlibabaCloud\Kms;

/**
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getSecretName()
 * @method $this withSecretName($value)
 * @method string getExtendedConfigCustomData()
 */
class UpdateSecret extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtendedConfigCustomData($value)
    {
        $this->data['ExtendedConfigCustomData'] = $value;
        $this->options['query']['ExtendedConfig.CustomData'] = $value;

        return $this;
    }
}
