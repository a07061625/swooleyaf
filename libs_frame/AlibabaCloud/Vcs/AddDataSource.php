<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getDataSourceType()
 * @method string getCorpId()
 * @method string getDescription()
 * @method string getDataSourceName()
 * @method string getFileRetentionDays()
 */
class AddDataSource extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataSourceType($value)
    {
        $this->data['DataSourceType'] = $value;
        $this->options['form_params']['DataSourceType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCorpId($value)
    {
        $this->data['CorpId'] = $value;
        $this->options['form_params']['CorpId'] = $value;

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
    public function withDataSourceName($value)
    {
        $this->data['DataSourceName'] = $value;
        $this->options['form_params']['DataSourceName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFileRetentionDays($value)
    {
        $this->data['FileRetentionDays'] = $value;
        $this->options['form_params']['FileRetentionDays'] = $value;

        return $this;
    }
}
