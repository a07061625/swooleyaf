<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getAppGroupIdentity()
 */
class CreateScheduledTask extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/app-groups/[appGroupIdentity]/scheduled-tasks';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppGroupIdentity($value)
    {
        $this->data['AppGroupIdentity'] = $value;
        $this->pathParameters['appGroupIdentity'] = $value;

        return $this;
    }
}
