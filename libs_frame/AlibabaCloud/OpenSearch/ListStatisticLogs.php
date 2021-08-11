<?php

namespace AlibabaCloud\OpenSearch;

/**
 * @method string getColumns()
 * @method string getQuery()
 * @method string getPageSize()
 * @method string getModuleName()
 * @method string getDistinct()
 * @method string getSortBy()
 * @method string getStartTime()
 * @method string getStopTime()
 * @method string getAppGroupIdentity()
 * @method string getPageNumber()
 */
class ListStatisticLogs extends Roa
{
    /** @var string */
    public $pathPattern = '/v4/openapi/app-groups/[appGroupIdentity]/statistic-logs/[moduleName]';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withColumns($value)
    {
        $this->data['Columns'] = $value;
        $this->options['query']['columns'] = $value;

        return $this;
    }

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
    public function withModuleName($value)
    {
        $this->data['ModuleName'] = $value;
        $this->pathParameters['moduleName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDistinct($value)
    {
        $this->data['Distinct'] = $value;
        $this->options['query']['distinct'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSortBy($value)
    {
        $this->data['SortBy'] = $value;
        $this->options['query']['sortBy'] = $value;

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
