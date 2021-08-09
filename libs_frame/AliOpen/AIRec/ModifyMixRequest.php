<?php

namespace AliOpen\AIRec;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of ModifyMix
 *
 * @method string getInstanceId()
 * @method string getName()
 */
class ModifyMixRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/openapi/instances/[InstanceId]/mixes/[Name]';

    /**
     * @var string
     */
    protected $method = 'PUT';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'Airec',
            '2018-10-12',
            'ModifyMix',
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

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->requestParameters['Name'] = $name;
        $this->pathParameters['Name'] = $name;

        return $this;
    }
}
