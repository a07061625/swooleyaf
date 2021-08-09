<?php

namespace AliOpen\ActionTrail;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeTrails
 *
 * @method string getIncludeShadowTrails()
 * @method string getNameList()
 */
class TrailsDescribeRequest extends RpcAcsRequest
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
        parent::__construct('Actiontrail', '2017-12-04', 'DescribeTrails', 'actiontrail');
    }

    /**
     * @param string $includeShadowTrails
     *
     * @return $this
     */
    public function setIncludeShadowTrails($includeShadowTrails)
    {
        $this->requestParameters['IncludeShadowTrails'] = $includeShadowTrails;
        $this->queryParameters['IncludeShadowTrails'] = $includeShadowTrails;

        return $this;
    }

    /**
     * @param string $nameList
     *
     * @return $this
     */
    public function setNameList($nameList)
    {
        $this->requestParameters['NameList'] = $nameList;
        $this->queryParameters['NameList'] = $nameList;

        return $this;
    }
}
