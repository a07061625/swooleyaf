<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getInstanceId()
 */
class QuerySingleAggregationReport extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/sync-reports/single-aggregation-report';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId($value)
    {
        $this->data['InstanceId'] = $value;
        $this->pathParameters['instanceId'] = $value;

        return $this;
    }
}
