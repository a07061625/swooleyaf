<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getSpec()
 */
class GenerateMergedTable extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/assist/schema/actions/merge';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSpec($value)
    {
        $this->data['Spec'] = $value;
        $this->options['query']['spec'] = $value;

        return $this;
    }
}
