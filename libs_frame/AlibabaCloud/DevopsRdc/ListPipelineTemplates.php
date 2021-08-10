<?php

namespace AlibabaCloud\DevopsRdc;

/**
 * @method string getPageStart()
 * @method $this withPageStart($value)
 * @method string getPageNum()
 * @method $this withPageNum($value)
 * @method string getOrgId()
 * @method $this withOrgId($value)
 */
class ListPipelineTemplates extends Rpc
{
    /** @var string */
    public $method = 'GET';
}
