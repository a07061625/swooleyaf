<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getAppId()
 * @method string getPageSize()
 * @method string getStartTime()
 * @method string getStopTime()
 * @method string getAppGroupIdentity()
 * @method string getPageNumber()
 */
class ListAppGroupErrors extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/app-groups/[appGroupIdentity]/errors';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['query']['appId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['query']['pageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartTime($value)
    {
        $this->data['StartTime'] = $value;
        $this->options['query']['startTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStopTime($value)
    {
        $this->data['StopTime'] = $value;
        $this->options['query']['stopTime'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNumber($value)
    {
        $this->data['PageNumber'] = $value;
        $this->options['query']['pageNumber'] = $value;

        return $this;
    }
}
