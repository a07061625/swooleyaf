<?php

namespace AlibabaCloud\Edas;

class ListServiceGroups extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/service/serviceGroups';

    /** @var string */
    public $method = 'GET';
}
