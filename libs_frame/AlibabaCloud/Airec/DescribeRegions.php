<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getAcceptLanguage()
 */
class DescribeRegions extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/configurations/regions';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAcceptLanguage($value)
    {
        $this->data['AcceptLanguage'] = $value;
        $this->options['query']['acceptLanguage'] = $value;

        return $this;
    }
}
