<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getIndexTemplate()
 */
class ListIndexTemplates extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/index-templates';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIndexTemplate($value)
    {
        $this->data['IndexTemplate'] = $value;
        $this->options['query']['indexTemplate'] = $value;

        return $this;
    }
}
