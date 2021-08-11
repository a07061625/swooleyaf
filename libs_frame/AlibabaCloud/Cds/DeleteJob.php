<?php

namespace AlibabaCloud\Cds;

/**
 * @method string getJobName()
 * @method $this withJobName($value)
 */
class DeleteJob extends Roa
{
    /** @var string */
    public $pathPattern = '/v1/job/[JobName]';

    /** @var string */
    public $method = 'DELETE';
}
