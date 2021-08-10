<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getClientToken()
 * @method string getTemplateName()
 * @method $this withTemplateName($value)
 */
class UpdateTemplate extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/templates/[TemplateName]';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['query']['ClientToken'] = $value;

        return $this;
    }
}
