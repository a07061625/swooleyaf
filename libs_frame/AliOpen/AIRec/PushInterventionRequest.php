<?php

namespace AliOpen\AIRec;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of PushIntervention
 *
 * @method string getInstanceId()
 */
class PushInterventionRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/openapi/instances/[InstanceId]/actions/intervene';

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
            'PushIntervention',
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
