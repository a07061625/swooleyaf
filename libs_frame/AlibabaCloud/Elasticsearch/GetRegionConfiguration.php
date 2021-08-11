<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getZoneId()
 */
class GetRegionConfiguration extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/region';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withZoneId($value)
    {
        $this->data['ZoneId'] = $value;
        $this->options['query']['zoneId'] = $value;

        return $this;
    }
}
