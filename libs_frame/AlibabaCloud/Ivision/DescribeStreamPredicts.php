<?php

namespace AlibabaCloud\Ivision;

/**
 * @method string getNextPageToken()
 * @method $this withNextPageToken($value)
 * @method string getPredictIds()
 * @method $this withPredictIds($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getShowLog()
 * @method $this withShowLog($value)
 * @method string getModelId()
 * @method $this withModelId($value)
 * @method string getCurrentPage()
 * @method $this withCurrentPage($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeStreamPredicts extends Rpc
{
    /** @var string */
    public $method = 'POST';
}
