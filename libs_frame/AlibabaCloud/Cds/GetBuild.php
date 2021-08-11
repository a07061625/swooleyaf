<?php

namespace AlibabaCloud\Cds;

/**
 * @method string getBuildNumber()
 * @method $this withBuildNumber($value)
 * @method string getJobName()
 * @method $this withJobName($value)
 */
class GetBuild extends Roa
{
    /** @var string */
    public $pathPattern = '/v1/job/[JobName]/build/[BuildNumber]';

    /** @var string */
    public $method = 'GET';
}
