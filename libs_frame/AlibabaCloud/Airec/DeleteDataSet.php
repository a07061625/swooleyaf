<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getVersionId()
 * @method string getInstanceId()
 */
class DeleteDataSet extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/dataSets/[versionId]';

    /** @var string */
    public $method = 'DELETE';

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
}
