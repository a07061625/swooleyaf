<?php

namespace AliOpen\BssOpenApi;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeResourcePackageProduct
 *
 * @method string getProductCode()
 */
class DescribeResourcePackageProductRequest extends RpcAcsRequest
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
        parent::__construct('BssOpenApi', '2017-12-14', 'DescribeResourcePackageProduct', 'BssOpenApi');
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
}
