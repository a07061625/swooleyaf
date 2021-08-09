<?php

namespace AliOpen\Arms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DeleteRetcodeApp
 *
 * @method string getAppId()
 */
class DeleteRetcodeAppRequest extends RpcAcsRequest
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
            'ARMS',
            '2019-08-08',
            'DeleteRetcodeApp',
            'arms'
        );
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
