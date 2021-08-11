<?php

namespace AlibabaCloud\Emr;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getLibraryBizId()
 * @method $this withLibraryBizId($value)
 * @method array getClusterBizIdList()
 */
class UninstallLibraries extends Rpc
{
    /**
     * @return $this
     */
    public function withClusterBizIdList(array $clusterBizIdList)
    {
        $this->data['ClusterBizIdList'] = $clusterBizIdList;
        foreach ($clusterBizIdList as $i => $iValue) {
            $this->options['query']['ClusterBizIdList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
