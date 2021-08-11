<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getInstanceId()
 * @method string getTableName()
 */
class PushDocument extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/tables/[tableName]/actions/bulk';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId($value)
    {
        $this->data['InstanceId'] = $value;
        $this->pathParameters['instanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTableName($value)
    {
        $this->data['TableName'] = $value;
        $this->pathParameters['tableName'] = $value;

        return $this;
    }
}
