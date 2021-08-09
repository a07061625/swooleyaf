<?php

namespace AliOpen\CusAnalyticScOnline;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetHeatMapData
 *
 * @method string getEMapName()
 * @method string getStoreId()
 */
class GetHeatMapDataRequest extends RpcAcsRequest
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
            'cusanalytic_sc_online',
            '2019-05-24',
            'GetHeatMapData'
        );
    }

    /**
     * @param string $eMapName
     *
     * @return $this
     */
    public function setEMapName($eMapName)
    {
        $this->requestParameters['EMapName'] = $eMapName;
        $this->queryParameters['EMapName'] = $eMapName;

        return $this;
    }

    /**
     * @param string $storeId
     *
     * @return $this
     */
    public function setStoreId($storeId)
    {
        $this->requestParameters['StoreId'] = $storeId;
        $this->queryParameters['StoreId'] = $storeId;

        return $this;
    }
}
