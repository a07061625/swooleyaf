<?php

namespace AlibabaCloud\Schedulerx2;

/**
 * @method string getNamespaceSource()
 * @method $this withNamespaceSource($value)
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method array getJobIdList()
 * @method string getNamespace()
 * @method $this withNamespace($value)
 */
class BatchDeleteJobs extends Rpc
{
    /** @var string */
    public $method = 'POST';

    /**
     * @return $this
     */
    public function withJobIdList(array $jobIdList)
    {
        $this->data['JobIdList'] = $jobIdList;
        foreach ($jobIdList as $i => $iValue) {
            $this->options['form_params']['JobIdList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
