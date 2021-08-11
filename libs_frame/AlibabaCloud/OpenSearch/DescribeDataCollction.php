<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getDataCollectionIdentity()
 * @method string getAppGroupIdentity()
 */
class DescribeDataCollction extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/app-groups/[appGroupIdentity]/data-collections/[dataCollectionIdentity]';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataCollectionIdentity($value)
    {
        $this->data['DataCollectionIdentity'] = $value;
        $this->pathParameters['dataCollectionIdentity'] = $value;

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
