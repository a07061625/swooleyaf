<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getQuery()
 * @method string getName()
 */
class ListInterventionDictionaryNerResults extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/intervention-dictionaries/[name]/ner-results';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withQuery($value)
    {
        $this->data['Query'] = $value;
        $this->options['query']['query'] = $value;

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
