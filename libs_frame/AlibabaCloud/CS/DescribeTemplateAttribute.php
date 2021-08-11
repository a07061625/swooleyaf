<?php

namespace AlibabaCloud\CS;

/**
 * @method string getTemplateId()
 * @method $this withTemplateId($value)
 */
class DescribeTemplateAttribute extends Roa
{
    /** @var string */
    public $pathPattern = '/templates/[TemplateId]';
}
