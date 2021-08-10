<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getUsageScenario()
 */
class RecommendTemplates extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/instances/[InstanceId]/recommended-templates';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUsageScenario($value)
    {
        $this->data['UsageScenario'] = $value;
        $this->options['query']['usageScenario'] = $value;

        return $this;
    }
}
