<?php
namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 *
 *
 * Request of SaveApScanConfig
 *
 * @method string getJsonData()
 * @method string getApConfigId()
 */
class SaveApScanConfigRequest extends RpcAcsRequest
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
            'SaveApScanConfig',
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
     * @param string $apConfigId
     *
     * @return $this
     */
    public function setApConfigId($apConfigId)
    {
        $this->requestParameters['ApConfigId'] = $apConfigId;
        $this->queryParameters['ApConfigId'] = $apConfigId;

        return $this;
    }
}
