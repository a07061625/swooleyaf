<?php
namespace AliOpen\CloudAuth;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeVerifySDK
 * @method string getSourceIp()
 * @method string getLang()
 * @method string getTaskId()
 */
class VerifySDKDescribeRequest extends RpcAcsRequest
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
        parent::__construct('Cloudauth', '2018-09-16', 'DescribeVerifySDK', 'cloudauth');
    }

    /**
     * @param string $sourceIp
     * @return $this
     */
    public function setSourceIp($sourceIp)
    {
        $this->requestParameters['SourceIp'] = $sourceIp;
        $this->queryParameters['SourceIp'] = $sourceIp;

        return $this;
    }

    /**
     * @param string $lang
     * @return $this
     */
    public function setLang($lang)
    {
        $this->requestParameters['Lang'] = $lang;
        $this->queryParameters['Lang'] = $lang;

        return $this;
    }

    /**
     * @param string $taskId
     * @return $this
     */
    public function setTaskId($taskId)
    {
        $this->requestParameters['TaskId'] = $taskId;
        $this->queryParameters['TaskId'] = $taskId;

        return $this;
    }
}
