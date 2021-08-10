<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getIsManaged()
 * @method string getName()
 */
class ListDataStreams extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/data-streams';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withIsManaged($value)
    {
        $this->data['IsManaged'] = $value;
        $this->options['query']['isManaged'] = $value;

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
