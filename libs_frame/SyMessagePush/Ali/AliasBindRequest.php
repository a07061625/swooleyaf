<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of BindAlias
 * @method string getDeviceId()
 * @method string getAliasName()
 * @method string getAppKey()
 */
class AliasBindRequest extends RpcAcsRequest
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
        parent::__construct('Push', '2016-08-01', 'BindAlias');
    }

    /**
     * @param string $deviceId
     * @return $this
     */
    public function setDeviceId($deviceId)
    {
        $this->requestParameters['DeviceId'] = $deviceId;
        $this->queryParameters['DeviceId'] = $deviceId;

        return $this;
    }

    /**
     * @param string $aliasName
     * @return $this
     */
    public function setAliasName($aliasName)
    {
        $this->requestParameters['AliasName'] = $aliasName;
        $this->queryParameters['AliasName'] = $aliasName;

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
}
