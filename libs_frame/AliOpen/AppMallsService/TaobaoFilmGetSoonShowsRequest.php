<?php

namespace AliOpen\AppMallsService;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of TaobaoFilmGetSoonShows
 *
 * @method string getCityCode()
 * @method string getParamsJson()
 */
class TaobaoFilmGetSoonShowsRequest extends RpcAcsRequest
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
            'AppMallsService',
            '2018-02-24',
            'TaobaoFilmGetSoonShows'
        );
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
     * @param string $paramsJson
     *
     * @return $this
     */
    public function setParamsJson($paramsJson)
    {
        $this->requestParameters['ParamsJson'] = $paramsJson;
        $this->queryParameters['ParamsJson'] = $paramsJson;

        return $this;
    }
}
