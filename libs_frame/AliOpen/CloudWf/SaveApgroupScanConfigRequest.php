<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SaveApgroupScanConfig
 *
 * @method string getJsonData()
 * @method string getApgroupId()
 */
class SaveApgroupScanConfigRequest extends RpcAcsRequest
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
            'SaveApgroupScanConfig',
            'cloudwf'
        );
    }

    /**
     * @param string $jsonData
     *
     * @return $this
     */
    public function setJsonData($jsonData)
    {
        $this->requestParameters['JsonData'] = $jsonData;
        $this->queryParameters['JsonData'] = $jsonData;

        return $this;
    }

    /**
     * @param string $apgroupId
     *
     * @return $this
     */
    public function setApgroupId($apgroupId)
    {
        $this->requestParameters['ApgroupId'] = $apgroupId;
        $this->queryParameters['ApgroupId'] = $apgroupId;

        return $this;
    }
}
