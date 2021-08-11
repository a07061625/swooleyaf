<?php

namespace AlibabaCloud\Nlp;

/**
 * @method string getDomain()
 * @method $this withDomain($value)
 */
class Sentiment extends Roa
{
    /** @var string */
    public $pathPattern = '/nlp/api/sentiment/[Domain]';
}
