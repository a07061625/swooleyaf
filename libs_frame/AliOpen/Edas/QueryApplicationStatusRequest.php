<?php

namespace AliOpen\Edas;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of QueryApplicationStatus
 *
 * @method string getAppId()
 */
class QueryApplicationStatusRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/pop/v5/app/app_status';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Edas', '2017-08-01', 'QueryApplicationStatus');
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
