<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetScanMode
 *
 * @method array getMacLists()
 */
class GetScanModeRequest extends RpcAcsRequest
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
            'GetScanMode',
            'cloudwf'
        );
    }

    /**
     * @return $this
     */
    public function setMacLists(array $value)
    {
        $this->requestParameters['MacLists'] = $value;
        foreach ($value as $i => $iValue) {
            $this->queryParameters['MacList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
