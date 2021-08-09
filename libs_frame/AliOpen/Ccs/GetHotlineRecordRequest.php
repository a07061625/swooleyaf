<?php

namespace AliOpen\Ccs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetHotlineRecord
 *
 * @method string getId()
 * @method string getCcsInstanceId()
 */
class GetHotlineRecordRequest extends RpcAcsRequest
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
            'Ccs',
            '2017-10-01',
            'GetHotlineRecord',
            'ccs'
        );
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->requestParameters['Id'] = $id;
        $this->queryParameters['Id'] = $id;

        return $this;
    }

    /**
     * @param string $ccsInstanceId
     *
     * @return $this
     */
    public function setCcsInstanceId($ccsInstanceId)
    {
        $this->requestParameters['CcsInstanceId'] = $ccsInstanceId;
        $this->queryParameters['CcsInstanceId'] = $ccsInstanceId;

        return $this;
    }
}
