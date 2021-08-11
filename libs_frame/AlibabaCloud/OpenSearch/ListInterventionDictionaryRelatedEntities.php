<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getName()
 */
class ListInterventionDictionaryRelatedEntities extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/intervention-dictionaries/[name]/related';

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
