<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getClientToken()
 * @method string getIndexTemplate()
 * @method $this withIndexTemplate($value)
 */
class UpdateIndexTemplate extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/index-templates/[IndexTemplate]';

    /** @var string */
    public $method = 'PUT';

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
