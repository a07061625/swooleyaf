<?php

namespace AliOpen\Cr;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetRepoBuildRecord
 *
 * @method string getBuildRecordId()
 * @method string getInstanceId()
 */
class GetRepoBuildRecordRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'cr',
            '2018-12-01',
            'GetRepoBuildRecord',
            'acr'
        );
    }

    /**
     * @param string $buildRecordId
     *
     * @return $this
     */
    public function setBuildRecordId($buildRecordId)
    {
        $this->requestParameters['BuildRecordId'] = $buildRecordId;
        $this->queryParameters['BuildRecordId'] = $buildRecordId;

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
        $this->queryParameters['InstanceId'] = $instanceId;

        return $this;
    }
}
