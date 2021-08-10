<?php

namespace AlibabaCloud\Smc;

/**
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getJobId()
 * @method $this withJobId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getState()
 * @method $this withState($value)
 * @method array getSourceId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getName()
 * @method $this withName($value)
 */
class DescribeSourceServers extends Rpc
{
    /**
     * @return $this
     */
    public function withSourceId(array $sourceId)
    {
        $this->data['SourceId'] = $sourceId;
        foreach ($sourceId as $i => $iValue) {
            $this->options['query']['SourceId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
