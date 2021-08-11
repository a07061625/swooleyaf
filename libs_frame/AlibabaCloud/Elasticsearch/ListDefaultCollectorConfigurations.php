<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getResType()
 * @method string getResVersion()
 * @method string getSourceType()
 */
class ListDefaultCollectorConfigurations extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/beats/default-configurations';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withResType($value)
    {
        $this->data['ResType'] = $value;
        $this->options['query']['resType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withResVersion($value)
    {
        $this->data['ResVersion'] = $value;
        $this->options['query']['resVersion'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceType($value)
    {
        $this->data['SourceType'] = $value;
        $this->options['query']['sourceType'] = $value;

        return $this;
    }
}
