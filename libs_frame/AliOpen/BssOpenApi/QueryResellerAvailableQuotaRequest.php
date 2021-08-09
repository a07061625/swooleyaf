<?php

namespace AliOpen\BssOpenApi;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of QueryResellerAvailableQuota
 *
 * @method string getItemCodes()
 * @method string getOwnerId()
 */
class QueryResellerAvailableQuotaRequest extends RpcAcsRequest
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
        parent::__construct('BssOpenApi', '2017-12-14', 'QueryResellerAvailableQuota', 'BssOpenApi');
    }

    /**
     * @param string $itemCodes
     *
     * @return $this
     */
    public function setItemCodes($itemCodes)
    {
        $this->requestParameters['ItemCodes'] = $itemCodes;
        $this->queryParameters['ItemCodes'] = $itemCodes;

        return $this;
    }

    /**
     * @param string $ownerId
     *
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }
}
