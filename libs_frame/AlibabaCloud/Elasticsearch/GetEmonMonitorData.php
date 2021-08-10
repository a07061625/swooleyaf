<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getProjectId()
 * @method $this withProjectId($value)
 */
class GetEmonMonitorData extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/emon/projects/[ProjectId]/metrics/query';
}
