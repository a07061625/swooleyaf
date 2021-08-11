<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getDataSourceType()
 * @method string getParams()
 */
class ListDataSourceTableFields extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/assist/data-sources/[dataSourceType]/fields';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataSourceType($value)
    {
        $this->data['DataSourceType'] = $value;
        $this->pathParameters['dataSourceType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withParams($value)
    {
        $this->data['Params'] = $value;
        $this->options['query']['params'] = $value;

        return $this;
    }
}
