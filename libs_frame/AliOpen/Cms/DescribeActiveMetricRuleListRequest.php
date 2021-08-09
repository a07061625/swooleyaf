<?php

namespace AliOpen\Cms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeActiveMetricRuleList
 *
 * @method string getProduct()
 */
class DescribeActiveMetricRuleListRequest extends RpcAcsRequest
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
            'Cms',
            '2019-01-01',
            'DescribeActiveMetricRuleList',
            'cms'
        );
    }

    /**
     * @param string $product
     *
     * @return $this
     */
    public function setProduct($product)
    {
        $this->requestParameters['Product'] = $product;
        $this->queryParameters['Product'] = $product;

        return $this;
    }
}
