<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryDevicesByAlias
 * @method string getAlias()
 * @method string getAppKey()
 */
class DevicesByAliasQueryRequest extends RpcAcsRequest
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
        parent::__construct('Push', '2016-08-01', 'QueryDevicesByAlias');
    }

    /**
     * @param string $alias
     * @return $this
     */
    public function setAlias($alias)
    {
        $this->requestParameters['Alias'] = $alias;
        $this->queryParameters['Alias'] = $alias;

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
