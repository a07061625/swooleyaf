<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetOssServerSign
 *
 * @method string getDirType()
 */
class GetOssServerSignRequest extends RpcAcsRequest
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
            'GetOssServerSign',
            'cloudwf'
        );
    }

    /**
     * @param string $dirType
     *
     * @return $this
     */
    public function setDirType($dirType)
    {
        $this->requestParameters['DirType'] = $dirType;
        $this->queryParameters['DirType'] = $dirType;

        return $this;
    }
}
