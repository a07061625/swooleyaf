<?php

namespace AlibabaCloud\VoiceNavigator;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getExportTaskId()
 * @method $this withExportTaskId($value)
 */
class DescribeExportProgress extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
