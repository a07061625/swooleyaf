<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getTaskType()
 * @method string getClientToken()
 */
class CancelTask extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/actions/cancel-task';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskType($value)
    {
        $this->data['TaskType'] = $value;
        $this->options['query']['taskType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['query']['clientToken'] = $value;

        return $this;
    }
}
