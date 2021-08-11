<?php

namespace AlibabaCloud\Edas;

class ListSlb extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/slb_list';

    /** @var string */
    public $method = 'GET';
}
