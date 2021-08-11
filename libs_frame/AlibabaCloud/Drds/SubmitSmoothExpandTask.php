<?php

namespace AlibabaCloud\Drds;

/**
 * @method string getDrdsInstanceId()
 * @method $this withDrdsInstanceId($value)
 * @method string getDbInstanceIsCreating()
 * @method $this withDbInstanceIsCreating($value)
 * @method array getRdsSuperInstances()
 * @method string getDbName()
 * @method $this withDbName($value)
 * @method array getTransferTaskInfos()
 */
class SubmitSmoothExpandTask extends Rpc
{
    /**
     * @return $this
     */
    public function withRdsSuperInstances(array $rdsSuperInstances)
    {
        $this->data['RdsSuperInstances'] = $rdsSuperInstances;
        foreach ($rdsSuperInstances as $depth1 => $depth1Value) {
            if (isset($depth1Value['Password'])) {
                $this->options['query']['RdsSuperInstances.' . ($depth1 + 1) . '.Password'] = $depth1Value['Password'];
            }
            if (isset($depth1Value['AccountName'])) {
                $this->options['query']['RdsSuperInstances.' . ($depth1 + 1) . '.AccountName'] = $depth1Value['AccountName'];
            }
            if (isset($depth1Value['RdsName'])) {
                $this->options['query']['RdsSuperInstances.' . ($depth1 + 1) . '.RdsName'] = $depth1Value['RdsName'];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withTransferTaskInfos(array $transferTaskInfos)
    {
        $this->data['TransferTaskInfos'] = $transferTaskInfos;
        foreach ($transferTaskInfos as $depth1 => $depth1Value) {
            if (isset($depth1Value['DbName'])) {
                $this->options['query']['TransferTaskInfos.' . ($depth1 + 1) . '.DbName'] = $depth1Value['DbName'];
            }
            if (isset($depth1Value['SrcInstanceName'])) {
                $this->options['query']['TransferTaskInfos.' . ($depth1 + 1) . '.SrcInstanceName'] = $depth1Value['SrcInstanceName'];
            }
            if (isset($depth1Value['InstanceType'])) {
                $this->options['query']['TransferTaskInfos.' . ($depth1 + 1) . '.InstanceType'] = $depth1Value['InstanceType'];
            }
            if (isset($depth1Value['DstInstanceName'])) {
                $this->options['query']['TransferTaskInfos.' . ($depth1 + 1) . '.DstInstanceName'] = $depth1Value['DstInstanceName'];
            }
        }

        return $this;
    }
}
