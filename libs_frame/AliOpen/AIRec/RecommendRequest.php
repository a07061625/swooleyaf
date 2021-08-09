<?php

namespace AliOpen\AIRec;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of Recommend
 *
 * @method string getReturnCount()
 * @method string getInstanceId()
 * @method string getIp()
 * @method string getSceneId()
 * @method string getImei()
 * @method string getUserId()
 * @method string getItems()
 */
class RecommendRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/openapi/instances/[InstanceId]/actions/recommend';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'Airec',
            '2018-10-12',
            'Recommend',
            'airec'
        );
    }

    /**
     * @param string $returnCount
     *
     * @return $this
     */
    public function setReturnCount($returnCount)
    {
        $this->requestParameters['ReturnCount'] = $returnCount;
        $this->queryParameters['ReturnCount'] = $returnCount;

        return $this;
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

    /**
     * @param string $ip
     *
     * @return $this
     */
    public function setIp($ip)
    {
        $this->requestParameters['Ip'] = $ip;
        $this->queryParameters['Ip'] = $ip;

        return $this;
    }

    /**
     * @param string $sceneId
     *
     * @return $this
     */
    public function setSceneId($sceneId)
    {
        $this->requestParameters['SceneId'] = $sceneId;
        $this->queryParameters['SceneId'] = $sceneId;

        return $this;
    }

    /**
     * @param string $imei
     *
     * @return $this
     */
    public function setImei($imei)
    {
        $this->requestParameters['Imei'] = $imei;
        $this->queryParameters['Imei'] = $imei;

        return $this;
    }

    /**
     * @param string $userId
     *
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->requestParameters['UserId'] = $userId;
        $this->queryParameters['UserId'] = $userId;

        return $this;
    }

    /**
     * @param string $items
     *
     * @return $this
     */
    public function setItems($items)
    {
        $this->requestParameters['Items'] = $items;
        $this->queryParameters['Items'] = $items;

        return $this;
    }
}
