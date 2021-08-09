<?php

namespace AliOpen\AliDNS;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteGtmAddressPool
 *
 * @method string getAddrPoolId()
 * @method string getUserClientIp()
 * @method string getLang()
 */
class DeleteGtmAddressPoolRequest extends RpcAcsRequest
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
            'Alidns',
            '2015-01-09',
            'DeleteGtmAddressPool',
            'alidns'
        );
    }

    /**
     * @param string $addrPoolId
     *
     * @return $this
     */
    public function setAddrPoolId($addrPoolId)
    {
        $this->requestParameters['AddrPoolId'] = $addrPoolId;
        $this->queryParameters['AddrPoolId'] = $addrPoolId;

        return $this;
    }

    /**
     * @param string $userClientIp
     *
     * @return $this
     */
    public function setUserClientIp($userClientIp)
    {
        $this->requestParameters['UserClientIp'] = $userClientIp;
        $this->queryParameters['UserClientIp'] = $userClientIp;

        return $this;
    }

    /**
     * @param string $lang
     *
     * @return $this
     */
    public function setLang($lang)
    {
        $this->requestParameters['Lang'] = $lang;
        $this->queryParameters['Lang'] = $lang;

        return $this;
    }
}
