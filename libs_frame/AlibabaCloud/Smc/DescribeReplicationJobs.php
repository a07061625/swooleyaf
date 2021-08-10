<?php

namespace AlibabaCloud\Smc;

/**
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method array getJobId()
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method array getSourceId()
 * @method string getBusinessStatus()
 * @method $this withBusinessStatus($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class DescribeReplicationJobs extends Rpc
{
    /**
     * @return $this
     */
    public function withJobId(array $jobId)
    {
        $this->data['JobId'] = $jobId;
        foreach ($jobId as $i => $iValue) {
            $this->options['query']['JobId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

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
