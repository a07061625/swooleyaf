<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getPageNum()
 * @method string getDataSourceIdList()
 * @method string getPageSize()
 */
class ListCityMapCameraResults extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNum($value)
    {
        $this->data['PageNum'] = $value;
        $this->options['form_params']['PageNum'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataSourceIdList($value)
    {
        $this->data['DataSourceIdList'] = $value;
        $this->options['form_params']['DataSourceIdList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['form_params']['PageSize'] = $value;

        return $this;
    }
}
