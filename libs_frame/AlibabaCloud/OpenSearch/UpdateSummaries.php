<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getDryRun()
 * @method string getAppId()
 * @method string getAppGroupIdentity()
 */
class UpdateSummaries extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/app-groups/[appGroupIdentity]/apps/[appId]/summaries';

    /** @var string */
    public $method = 'PUT';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDryRun($value)
    {
        $this->data['DryRun'] = $value;
        $this->options['query']['dryRun'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->pathParameters['appId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppGroupIdentity($value)
    {
        $this->data['AppGroupIdentity'] = $value;
        $this->pathParameters['appGroupIdentity'] = $value;

        return $this;
    }
}
