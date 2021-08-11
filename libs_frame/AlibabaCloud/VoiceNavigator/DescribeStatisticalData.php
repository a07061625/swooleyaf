<?php

namespace AlibabaCloud\VoiceNavigator;

/**
 * @method string getBeginTimeLeftRange()
 * @method $this withBeginTimeLeftRange($value)
 * @method string getTimeUnit()
 * @method $this withTimeUnit($value)
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getBeginTimeRightRange()
 * @method $this withBeginTimeRightRange($value)
 */
class DescribeStatisticalData extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
