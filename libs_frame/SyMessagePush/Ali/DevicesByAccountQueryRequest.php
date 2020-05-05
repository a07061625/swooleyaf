<?php
namespace SyMessagePush\Ali;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryDevicesByAccount
 * @method string getAppKey()
 * @method string getAccount()
 */
class DevicesByAccountQueryRequest extends RpcAcsRequest
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
        parent::__construct('Push', '2016-08-01', 'QueryDevicesByAccount');
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
     * @param string $account
     * @return $this
     */
    public function setAccount($account)
    {
        $this->requestParameters['Account'] = $account;
        $this->queryParameters['Account'] = $account;

        return $this;
    }
}
