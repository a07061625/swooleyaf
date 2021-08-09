<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetBids4Uid4Root
 *
 * @method string getUid()
 */
class GetBids4Uid4RootRequest extends RpcAcsRequest
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
            'cloudwf',
            '2017-03-28',
            'GetBids4Uid4Root',
            'cloudwf'
        );
    }

    /**
     * @param string $uid
     *
     * @return $this
     */
    public function setUid($uid)
    {
        $this->requestParameters['Uid'] = $uid;
        $this->queryParameters['Uid'] = $uid;

        return $this;
    }
}
