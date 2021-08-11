<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getInstanceId()
 */
class ListDataSource extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/dataSources';

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
}
