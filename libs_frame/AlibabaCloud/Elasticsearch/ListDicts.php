<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getAnalyzerType()
 * @method string getName()
 */
class ListDicts extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/dicts';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAnalyzerType($value)
    {
        $this->data['AnalyzerType'] = $value;
        $this->options['query']['analyzerType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withName($value)
    {
        $this->data['Name'] = $value;
        $this->options['query']['name'] = $value;

        return $this;
    }
}
