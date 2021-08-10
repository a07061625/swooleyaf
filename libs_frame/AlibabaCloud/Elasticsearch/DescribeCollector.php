<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getResId()
 * @method $this withResId($value)
 */
class DescribeCollector extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/collectors/[ResId]';

    /** @var string */
    public $method = 'GET';
}
