<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getModelName()
 * @method string getAppGroupIdentity()
 */
class DescribeModel extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/app-groups/[appGroupIdentity]/algorithm/models/[modelName]';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withModelName($value)
    {
        $this->data['ModelName'] = $value;
        $this->pathParameters['modelName'] = $value;

        return $this;
    }

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
