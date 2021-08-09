<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of OemFlowrateIntelligent
 *
 * @method string getGsid()
 */
class OemFlowrateIntelligentRequest extends RpcAcsRequest
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
            'cloudwf',
            '2017-03-28',
            'OemFlowrateIntelligent',
            'cloudwf'
        );
    }

    /**
     * @param string $gsid
     *
     * @return $this
     */
    public function setGsid($gsid)
    {
        $this->requestParameters['Gsid'] = $gsid;
        $this->queryParameters['Gsid'] = $gsid;

        return $this;
    }
}
