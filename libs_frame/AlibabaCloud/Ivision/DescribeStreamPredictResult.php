<?php

namespace AlibabaCloud\Ivision;

/**
 * @method string getNextPageToken()
 * @method $this withNextPageToken($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPredictId()
 * @method $this withPredictId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getProbabilityThreshold()
 * @method $this withProbabilityThreshold($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getModelId()
 * @method $this withModelId($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getCurrentPage()
 * @method $this withCurrentPage($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeStreamPredictResult extends Rpc
{
    /** @var string */
    public $method = 'POST';
}
