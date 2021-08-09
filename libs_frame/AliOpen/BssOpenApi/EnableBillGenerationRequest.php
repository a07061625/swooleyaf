<?php

namespace AliOpen\BssOpenApi;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of EnableBillGeneration
 *
 * @method string getProductCode()
 * @method string getOwnerId()
 */
class EnableBillGenerationRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'PUT';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('BssOpenApi', '2017-12-14', 'EnableBillGeneration', 'BssOpenApi');
    }

    /**
     * @param string $productCode
     *
     * @return $this
     */
    public function setProductCode($productCode)
    {
        $this->requestParameters['ProductCode'] = $productCode;
        $this->queryParameters['ProductCode'] = $productCode;

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
