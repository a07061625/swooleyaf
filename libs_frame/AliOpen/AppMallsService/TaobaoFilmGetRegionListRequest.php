<?php

namespace AliOpen\AppMallsService;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of TaobaoFilmGetRegionList
 *
 * @method string getParamsJson()
 */
class TaobaoFilmGetRegionListRequest extends RpcAcsRequest
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
            'TaobaoFilmGetRegionList'
        );
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
