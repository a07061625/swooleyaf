<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getPageSize()
 * @method string getPageNumber()
 * @method string getClusterInstanceId()
 */
class ListPersistentVolume extends Rpc
{
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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNumber($value)
    {
        $this->data['PageNumber'] = $value;
        $this->options['form_params']['PageNumber'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClusterInstanceId($value)
    {
        $this->data['ClusterInstanceId'] = $value;
        $this->options['form_params']['ClusterInstanceId'] = $value;

        return $this;
    }
}
