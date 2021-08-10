<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getAlarmGroupId()
 * @method $this withAlarmGroupId($value)
 * @method string getProjectId()
 * @method $this withProjectId($value)
 */
class PostEmonTryAlarmRule extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/emon/projects/[ProjectId]/alarm-groups/[AlarmGroupId]/alarm-rules/_test';
}
