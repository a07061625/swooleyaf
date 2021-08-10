<?php

namespace AlibabaCloud\Rtc;

/**
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method array getTaskIds()
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAppId()
 * @method $this withAppId($value)
 * @method string getChannelId()
 * @method $this withChannelId($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class DescribeRecordTasks extends Rpc
{
    /**
     * @return $this
     */
    public function withTaskIds(array $taskIds)
    {
        $this->data['TaskIds'] = $taskIds;
        foreach ($taskIds as $i => $iValue) {
            $this->options['query']['TaskIds.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
