<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getInstanceId()
 */
class ListUserClusters extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/user-clusters';

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
