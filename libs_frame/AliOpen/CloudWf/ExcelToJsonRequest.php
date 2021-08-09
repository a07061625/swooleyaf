<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ExcelToJson
 *
 * @method string getUploadData()
 */
class ExcelToJsonRequest extends RpcAcsRequest
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
            'ExcelToJson',
            'cloudwf'
        );
    }

    /**
     * @param string $uploadData
     *
     * @return $this
     */
    public function setUploadData($uploadData)
    {
        $this->requestParameters['UploadData'] = $uploadData;
        $this->queryParameters['UploadData'] = $uploadData;

        return $this;
    }
}
