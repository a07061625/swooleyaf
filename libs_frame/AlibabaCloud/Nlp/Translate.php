<?php

namespace AlibabaCloud\Nlp;

/**
 * @method string getDomain()
 * @method $this withDomain($value)
 */
class Translate extends Roa
{
    /** @var string */
    public $pathPattern = '/nlp/api/translate/[Domain]';
}
