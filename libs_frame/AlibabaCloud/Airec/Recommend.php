<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getReturnCount()
 * @method string getServiceType()
 * @method string getInstanceId()
 * @method string getDebug()
 * @method string getIp()
 * @method string getLogLevel()
 * @method string getSceneId()
 * @method string getImei()
 * @method string getExperimentId()
 * @method string getUserId()
 * @method string getItems()
 * @method string getUserInfo()
 */
class Recommend extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/actions/recommend';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withReturnCount($value)
    {
        $this->data['ReturnCount'] = $value;
        $this->options['query']['returnCount'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withServiceType($value)
    {
        $this->data['ServiceType'] = $value;
        $this->options['query']['serviceType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId($value)
    {
        $this->data['InstanceId'] = $value;
        $this->pathParameters['instanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDebug($value)
    {
        $this->data['Debug'] = $value;
        $this->options['query']['debug'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIp($value)
    {
        $this->data['Ip'] = $value;
        $this->options['query']['ip'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLogLevel($value)
    {
        $this->data['LogLevel'] = $value;
        $this->options['query']['logLevel'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSceneId($value)
    {
        $this->data['SceneId'] = $value;
        $this->options['query']['sceneId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withImei($value)
    {
        $this->data['Imei'] = $value;
        $this->options['query']['imei'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExperimentId($value)
    {
        $this->data['ExperimentId'] = $value;
        $this->options['query']['experimentId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserId($value)
    {
        $this->data['UserId'] = $value;
        $this->options['query']['userId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withItems($value)
    {
        $this->data['Items'] = $value;
        $this->options['query']['items'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserInfo($value)
    {
        $this->data['UserInfo'] = $value;
        $this->options['query']['userInfo'] = $value;

        return $this;
    }
}
