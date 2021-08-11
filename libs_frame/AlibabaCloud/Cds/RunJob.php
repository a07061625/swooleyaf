<?php

namespace AlibabaCloud\Cds;

/**
 * @method string getJobName()
 * @method $this withJobName($value)
 */
class RunJob extends Roa
{
    /** @var string */
    public $pathPattern = '/v1/job/[JobName]/run';
}
