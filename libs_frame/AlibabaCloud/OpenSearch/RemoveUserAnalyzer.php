<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getName()
 */
class RemoveUserAnalyzer extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/user-analyzers/[name]';

    /** @var string */
    public $method = 'DELETE';

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
