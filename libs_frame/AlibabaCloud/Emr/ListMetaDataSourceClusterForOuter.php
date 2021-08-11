<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getClusterId()
 * @method string getUserId()
 * @method $this withUserId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method array getDataSourceId()
 * @method string getPageSize()
 * @method $this withPageSize($value)
 */
class ListMetaDataSourceClusterForOuter extends Rpc
{
    /**
     * @return $this
     */
    public function withClusterId(array $clusterId)
    {
        $this->data['ClusterId'] = $clusterId;
        foreach ($clusterId as $i => $iValue) {
            $this->options['query']['ClusterId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withDataSourceId(array $dataSourceId)
    {
        $this->data['DataSourceId'] = $dataSourceId;
        foreach ($dataSourceId as $i => $iValue) {
            $this->options['query']['DataSourceId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
