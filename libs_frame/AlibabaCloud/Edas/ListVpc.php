<?php

namespace AlibabaCloud\Edas;

class ListVpc extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/vpc_list';

    /** @var string */
    public $method = 'GET';
}
