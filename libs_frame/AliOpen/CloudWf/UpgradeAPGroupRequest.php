<?php

namespace AliOpen\CloudWf;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of UpgradeAPGroup
 *
 * @method array getIdss()
 */
class UpgradeAPGroupRequest extends RpcAcsRequest
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
            'UpgradeAPGroup',
            'cloudwf'
        );
    }

    /**
     * @return $this
     */
    public function setIdss(array $value)
    {
        $this->requestParameters['Idss'] = $value;
        foreach ($value as $i => $iValue) {
            $this->queryParameters['Ids.' . ($i + 1)] = $iValue;
        }

        return $this;
    }
}
