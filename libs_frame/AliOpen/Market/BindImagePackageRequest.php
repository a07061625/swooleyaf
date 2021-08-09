<?php

namespace AliOpen\Market;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of BindImagePackage
 *
 * @method string getEcsInstanceId()
 * @method string getImagePackageInstanceId()
 */
class BindImagePackageRequest extends RpcAcsRequest
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
        parent::__construct('Market', '2015-11-01', 'BindImagePackage', 'yunmarket');
    }

    /**
     * @param string $ecsInstanceId
     *
     * @return $this
     */
    public function setEcsInstanceId($ecsInstanceId)
    {
        $this->requestParameters['EcsInstanceId'] = $ecsInstanceId;
        $this->queryParameters['EcsInstanceId'] = $ecsInstanceId;

        return $this;
    }

    /**
     * @param string $imagePackageInstanceId
     *
     * @return $this
     */
    public function setImagePackageInstanceId($imagePackageInstanceId)
    {
        $this->requestParameters['ImagePackageInstanceId'] = $imagePackageInstanceId;
        $this->queryParameters['ImagePackageInstanceId'] = $imagePackageInstanceId;

        return $this;
    }
}
