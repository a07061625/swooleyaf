<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getLang()
 */
class ListDiagnoseIndices extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/diagnosis/instances/[InstanceId]/indices';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLang($value)
    {
        $this->data['Lang'] = $value;
        $this->options['query']['lang'] = $value;

        return $this;
    }
}
