<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of PeripheryAnalyse
 *
 * @method string getGsid()
 */
class PeripheryAnalyseRequest extends RpcAcsRequest
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
            'PeripheryAnalyse',
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
