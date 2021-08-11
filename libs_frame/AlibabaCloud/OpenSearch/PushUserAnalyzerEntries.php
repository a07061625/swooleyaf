<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getName()
 */
class PushUserAnalyzerEntries extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/user-analyzers/[name]/entries/actions/bulk';

    /** @var string */
    public $method = 'POST';

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
