<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getWith()
 * @method string getName()
 */
class DescribeUserAnalyzer extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/user-analyzers/[name]';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWith($value)
    {
        $this->data['With'] = $value;
        $this->options['query']['with'] = $value;

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
        $this->pathParameters['name'] = $value;

        return $this;
    }
}
