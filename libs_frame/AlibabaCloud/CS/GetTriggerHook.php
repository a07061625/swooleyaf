<?php

namespace AlibabaCloud\CS;

/**
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getProjectId()
 * @method $this withProjectId($value)
 */
class GetTriggerHook extends Roa
{
    /** @var string */
    public $pathPattern = '/hook/trigger/[ClusterId]/[ProjectId]';
}
