<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getVersionId()
 * @method string getInstanceId()
 * @method string getAlgorithmId()
 */
class AttachIndexVersion extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/filtering-algorithms/[algorithmId]/index-versions/[versionId]/actions/attach';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVersionId($value)
    {
        $this->data['VersionId'] = $value;
        $this->pathParameters['versionId'] = $value;

        return $this;
    }

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
