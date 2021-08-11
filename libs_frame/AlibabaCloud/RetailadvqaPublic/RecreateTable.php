<?php

namespace AlibabaCloud\RetailadvqaPublic;

/**
 * @method string getAccessId()
 * @method string getTableSchema()
 * @method string getTenantId()
 * @method string getTableName()
 * @method string getOssPath()
 */
class RecreateTable extends Rpc
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
    public function withTableSchema($value)
    {
        $this->data['TableSchema'] = $value;
        $this->options['form_params']['TableSchema'] = $value;

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
    public function withTableName($value)
    {
        $this->data['TableName'] = $value;
        $this->options['form_params']['TableName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOssPath($value)
    {
        $this->data['OssPath'] = $value;
        $this->options['form_params']['OssPath'] = $value;

        return $this;
    }
}
