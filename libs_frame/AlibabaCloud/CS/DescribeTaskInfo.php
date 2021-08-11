<?php

namespace AlibabaCloud\CS;

/**
 * @method string getTaskId()
 * @method $this withTaskId($value)
 */
class DescribeTaskInfo extends Roa
{
    /** @var string */
    public $pathPattern = '/tasks/[TaskId]';
}
