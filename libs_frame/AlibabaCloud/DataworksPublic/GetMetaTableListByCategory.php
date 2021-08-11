<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getCategoryId()
 * @method $this withCategoryId($value)
 */
class GetMetaTableListByCategory extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
