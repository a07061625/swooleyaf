<?php

namespace AlibabaCloud\RetailadvqaPublic;

/**
 * @method string getAccessId()
 * @method string getTenantId()
 * @method string getDataSetName()
 * @method string getDataSetId()
 * @method string getType()
 * @method string getDataSet()
 * @method string getWorkspaceId()
 */
class UpdateDataset extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccessId($value)
    {
        $this->data['AccessId'] = $value;
        $this->options['form_params']['AccessId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTenantId($value)
    {
        $this->data['TenantId'] = $value;
        $this->options['form_params']['TenantId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataSetName($value)
    {
        $this->data['DataSetName'] = $value;
        $this->options['form_params']['DataSetName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataSetId($value)
    {
        $this->data['DataSetId'] = $value;
        $this->options['form_params']['DataSetId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withType($value)
    {
        $this->data['Type'] = $value;
        $this->options['form_params']['Type'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataSet($value)
    {
        $this->data['DataSet'] = $value;
        $this->options['form_params']['DataSet'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWorkspaceId($value)
    {
        $this->data['WorkspaceId'] = $value;
        $this->options['form_params']['WorkspaceId'] = $value;

        return $this;
    }
}
