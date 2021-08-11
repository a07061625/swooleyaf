<?php

namespace AlibabaCloud\OutboundBot;

/**
 * @method array getJobId()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 */
class ListJobs extends Rpc
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
}
