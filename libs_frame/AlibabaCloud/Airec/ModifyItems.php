<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getInstanceId()
 */
class ModifyItems extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/items';

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
