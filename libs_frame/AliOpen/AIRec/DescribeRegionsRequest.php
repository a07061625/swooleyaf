<?php

namespace AliOpen\AIRec;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of DescribeRegions
 *
 * @method string getAcceptLanguage()
 */
class DescribeRegionsRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/openapi/configurations/regions';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'Airec',
            '2018-10-12',
            'DescribeRegions',
            'airec'
        );
    }

    /**
     * @param string $acceptLanguage
     *
     * @return $this
     */
    public function setAcceptLanguage($acceptLanguage)
    {
        $this->requestParameters['AcceptLanguage'] = $acceptLanguage;
        $this->queryParameters['AcceptLanguage'] = $acceptLanguage;

        return $this;
    }
}
