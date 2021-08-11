<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getUserPk()
 * @method string getOrgId()
 * @method $this withOrgId($value)
 * @method string getPipelineId()
 * @method $this withPipelineId($value)
 * @method string getNewOwnerId()
 */
class TransferPipelineOwner extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserPk($value)
    {
        $this->data['UserPk'] = $value;
        $this->options['form_params']['UserPk'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNewOwnerId($value)
    {
        $this->data['NewOwnerId'] = $value;
        $this->options['form_params']['NewOwnerId'] = $value;

        return $this;
    }
}
