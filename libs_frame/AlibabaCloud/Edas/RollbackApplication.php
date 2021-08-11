<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppId()
 * @method string getGroupId()
 * @method string getBatchWaitTime()
 * @method string getBatch()
 * @method string getHistoryVersion()
 */
class RollbackApplication extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/changeorder/co_rollback';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['query']['AppId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGroupId($value)
    {
        $this->data['GroupId'] = $value;
        $this->options['query']['GroupId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBatchWaitTime($value)
    {
        $this->data['BatchWaitTime'] = $value;
        $this->options['query']['BatchWaitTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBatch($value)
    {
        $this->data['Batch'] = $value;
        $this->options['query']['Batch'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHistoryVersion($value)
    {
        $this->data['HistoryVersion'] = $value;
        $this->options['query']['HistoryVersion'] = $value;

        return $this;
    }
}
