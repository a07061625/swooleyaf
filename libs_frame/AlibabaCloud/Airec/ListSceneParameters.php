<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getInstanceId()
 */
class ListSceneParameters extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/dashboard/scene-parameters';

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
