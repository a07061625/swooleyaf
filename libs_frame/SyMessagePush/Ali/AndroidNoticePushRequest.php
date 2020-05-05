<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of PushNoticeToAndroid
 * @method string getExtParameters()
 * @method string getTitle()
 * @method string getBody()
 * @method string getJobKey()
 * @method string getTarget()
 * @method string getAppKey()
 * @method string getTargetValue()
 */
class AndroidNoticePushRequest extends RpcAcsRequest
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
        parent::__construct('Push', '2016-08-01', 'PushNoticeToAndroid');
    }

    /**
     * @param string $extParameters
     * @return $this
     */
    public function setExtParameters($extParameters)
    {
        $this->requestParameters['ExtParameters'] = $extParameters;
        $this->queryParameters['ExtParameters'] = $extParameters;

        return $this;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->requestParameters['Title'] = $title;
        $this->queryParameters['Title'] = $title;

        return $this;
    }

    /**
     * @param string $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->requestParameters['Body'] = $body;
        $this->queryParameters['Body'] = $body;

        return $this;
    }

    /**
     * @param string $jobKey
     * @return $this
     */
    public function setJobKey($jobKey)
    {
        $this->requestParameters['JobKey'] = $jobKey;
        $this->queryParameters['JobKey'] = $jobKey;

        return $this;
    }

    /**
     * @param string $target
     * @return $this
     */
    public function setTarget($target)
    {
        $this->requestParameters['Target'] = $target;
        $this->queryParameters['Target'] = $target;

        return $this;
    }

    /**
     * @param string $appKey
     * @return $this
     */
    public function setAppKey($appKey)
    {
        $this->requestParameters['AppKey'] = $appKey;
        $this->queryParameters['AppKey'] = $appKey;

        return $this;
    }

    /**
     * @param string $targetValue
     * @return $this
     */
    public function setTargetValue($targetValue)
    {
        $this->requestParameters['TargetValue'] = $targetValue;
        $this->queryParameters['TargetValue'] = $targetValue;

        return $this;
    }
}
