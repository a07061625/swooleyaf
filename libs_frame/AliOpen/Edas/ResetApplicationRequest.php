<?php

namespace AliOpen\Edas;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of ResetApplication
 *
 * @method string getAppId()
 * @method string getEccInfo()
 */
class ResetApplicationRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/pop/v5/changeorder/co_reset';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Edas', '2017-08-01', 'ResetApplication');
    }

    /**
     * @param string $appId
     *
     * @return $this
     */
    public function setAppId($appId)
    {
        $this->requestParameters['AppId'] = $appId;
        $this->queryParameters['AppId'] = $appId;

        return $this;
    }

    /**
     * @param string $eccInfo
     *
     * @return $this
     */
    public function setEccInfo($eccInfo)
    {
        $this->requestParameters['EccInfo'] = $eccInfo;
        $this->queryParameters['EccInfo'] = $eccInfo;

        return $this;
    }
}
