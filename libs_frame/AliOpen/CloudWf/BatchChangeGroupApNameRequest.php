<?php
namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 *
 *
 * Request of BatchChangeGroupApName
 *
 * @method string getJsonData()
 */
class BatchChangeGroupApNameRequest extends RpcAcsRequest
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
            'BatchChangeGroupApName',
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
}
