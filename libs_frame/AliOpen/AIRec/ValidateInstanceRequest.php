<?php

namespace AliOpen\AIRec;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of ValidateInstance
 *
 * @method string getInstanceId()
 */
class ValidateInstanceRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/openapi/instances/[InstanceId]/actions/validate';

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
            'Airec',
            '2018-10-12',
            'ValidateInstance',
            'airec'
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
        $this->pathParameters['InstanceId'] = $instanceId;

        return $this;
    }
}
