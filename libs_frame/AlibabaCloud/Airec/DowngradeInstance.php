<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getInstanceId()
 */
class DowngradeInstance extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/actions/downgrade';

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
