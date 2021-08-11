<?php

namespace AlibabaCloud\CS;

/**
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getProjectId()
 * @method $this withProjectId($value)
 */
class GetProjectEvents extends Roa
{
    /** @var string */
    public $pathPattern = '/clusters/[ClusterId]/projects/[ProjectId]/events';
}
