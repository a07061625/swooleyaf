<?php

namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ResetUserStatus
 *
 * @method string getInstanceId()
 * @method array getRamIdLists()
 */
class ResetUserStatusRequest extends RpcAcsRequest
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
            'CCC',
            '2017-07-05',
            'ResetUserStatus',
            'CCC'
        );
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

    /**
     * @return $this
     */
    public function setRamIdLists(array $ramIdList)
    {
        $this->requestParameters['RamIdLists'] = $ramIdList;
        foreach ($ramIdList as $i => $iValue) {
            $this->queryParameters['RamIdList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
