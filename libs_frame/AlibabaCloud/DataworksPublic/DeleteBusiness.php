<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getBusinessId()
 * @method string getProjectId()
 * @method string getProjectIdentifier()
 */
class DeleteBusiness extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBusinessId($value)
    {
        $this->data['BusinessId'] = $value;
        $this->options['form_params']['BusinessId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectId($value)
    {
        $this->data['ProjectId'] = $value;
        $this->options['form_params']['ProjectId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectIdentifier($value)
    {
        $this->data['ProjectIdentifier'] = $value;
        $this->options['form_params']['ProjectIdentifier'] = $value;

        return $this;
    }
}
