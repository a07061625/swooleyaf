<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getInstanceId()
 */
class UpgradeInstance extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/actions/upgrade';

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
}
