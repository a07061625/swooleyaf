<?php

namespace AliOpen\IndustryBrain;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetIndustryInfoLineageList
 *
 * @method string getIndustryCode()
 */
class GetIndustryInfoLineageListRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('industry-brain', '2018-07-12', 'GetIndustryInfoLineageList');
    }

    /**
     * @param string $industryCode
     *
     * @return $this
     */
    public function setIndustryCode($industryCode)
    {
        $this->requestParameters['IndustryCode'] = $industryCode;
        $this->queryParameters['IndustryCode'] = $industryCode;

        return $this;
    }
}
