<?php

namespace AliOpen\LinkedMall;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryUpcomingMovies
 *
 * @method string getCityCode()
 * @method string getExtJson()
 * @method string getBizId()
 */
class QueryUpcomingMoviesRequest extends RpcAcsRequest
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
        parent::__construct('linkedmall', '2018-01-16', 'QueryUpcomingMovies', 'linkedmall');
    }

    /**
     * @param string $cityCode
     *
     * @return $this
     */
    public function setCityCode($cityCode)
    {
        $this->requestParameters['CityCode'] = $cityCode;
        $this->queryParameters['CityCode'] = $cityCode;

        return $this;
    }

    /**
     * @param string $extJson
     *
     * @return $this
     */
    public function setExtJson($extJson)
    {
        $this->requestParameters['ExtJson'] = $extJson;
        $this->queryParameters['ExtJson'] = $extJson;

        return $this;
    }

    /**
     * @param string $bizId
     *
     * @return $this
     */
    public function setBizId($bizId)
    {
        $this->requestParameters['BizId'] = $bizId;
        $this->queryParameters['BizId'] = $bizId;

        return $this;
    }
}
