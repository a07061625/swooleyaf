<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getInstanceId()
 * @method string getAlgorithmId()
 */
class UnLockIndexVersion extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/filtering-algorithms/[algorithmId]/actions/unlock';

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
    public function withAlgorithmId($value)
    {
        $this->data['AlgorithmId'] = $value;
        $this->pathParameters['algorithmId'] = $value;

        return $this;
    }
}
