<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getTableGuid()
 * @method string getBusinessId()
 * @method string getProjectId()
 * @method string getProjectIdentifier()
 * @method string getFolderId()
 */
class EstablishRelationTableToBusiness extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTableGuid($value)
    {
        $this->data['TableGuid'] = $value;
        $this->options['form_params']['TableGuid'] = $value;

        return $this;
    }

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFolderId($value)
    {
        $this->data['FolderId'] = $value;
        $this->options['form_params']['FolderId'] = $value;

        return $this;
    }
}
