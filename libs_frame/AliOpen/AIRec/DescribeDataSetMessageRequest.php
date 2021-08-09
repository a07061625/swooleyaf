<?php

namespace AliOpen\AIRec;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of DescribeDataSetMessage
 *
 * @method string getVersionId()
 * @method string getInstanceId()
 */
class DescribeDataSetMessageRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/openapi/instances/[InstanceId]/dataSets/[VersionId]/messages';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'Airec',
            '2018-10-12',
            'DescribeDataSetMessage',
            'airec'
        );
    }

    /**
     * @param string $versionId
     *
     * @return $this
     */
    public function setVersionId($versionId)
    {
        $this->requestParameters['VersionId'] = $versionId;
        $this->pathParameters['VersionId'] = $versionId;

        return $this;
    }

    /**
     * @param string $instanceId
     *
     * @return $this
     */
    public function setInstanceId($instanceId)
    {
        $this->requestParameters['InstanceId'] = $instanceId;
        $this->pathParameters['InstanceId'] = $instanceId;

        return $this;
    }
}
