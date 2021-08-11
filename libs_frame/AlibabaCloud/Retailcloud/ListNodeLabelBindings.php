<?php

namespace AlibabaCloud\Retailcloud;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getLabelKey()
 * @method $this withLabelKey($value)
 * @method string getLabelValue()
 * @method $this withLabelValue($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getClusterId()
 * @method $this withClusterId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 */
class ListNodeLabelBindings extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
