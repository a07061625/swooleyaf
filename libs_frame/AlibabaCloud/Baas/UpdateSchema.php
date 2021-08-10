<?php

namespace AlibabaCloud\Baas;

/**
 * @method string getSchemaName()
 * @method string getSchemaId()
 * @method string getBizid()
 * @method string getDescription()
 * @method string getCategoryConfigs()
 */
class UpdateSchema extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSchemaName($value)
    {
        $this->data['SchemaName'] = $value;
        $this->options['form_params']['SchemaName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSchemaId($value)
    {
        $this->data['SchemaId'] = $value;
        $this->options['form_params']['SchemaId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizid($value)
    {
        $this->data['Bizid'] = $value;
        $this->options['form_params']['Bizid'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['form_params']['Description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCategoryConfigs($value)
    {
        $this->data['CategoryConfigs'] = $value;
        $this->options['form_params']['CategoryConfigs'] = $value;

        return $this;
    }
}
