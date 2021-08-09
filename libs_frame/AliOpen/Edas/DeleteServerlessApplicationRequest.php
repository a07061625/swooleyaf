<?php

namespace AliOpen\Edas;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of DeleteServerlessApplication
 *
 * @method string getAct()
 * @method string getAppId()
 */
class DeleteServerlessApplicationRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/pop/v5/k8s/pop/pop_serverless_app_delete';
    /**
     * @var string
     */
    protected $method = 'DELETE';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Edas', '2017-08-01', 'DeleteServerlessApplication');
    }

    /**
     * @param string $act
     *
     * @return $this
     */
    public function setAct($act)
    {
        $this->requestParameters['Act'] = $act;
        $this->queryParameters['Act'] = $act;

        return $this;
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
}
