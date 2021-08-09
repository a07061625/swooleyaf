<?php

namespace AliOpen\AIRec;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of ListMix
 *
 * @method string getInstanceId()
 */
class ListMixRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/openapi/instances/[InstanceId]/mixes';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'Airec',
            '2018-10-12',
            'ListMix',
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
