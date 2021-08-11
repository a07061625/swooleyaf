<?php

namespace AlibabaCloud\Airec;

/**
 * @method string getTraceId()
 * @method string getMessageSource()
 * @method string getEndTime()
 * @method string getUserType()
 * @method string getStartTime()
 * @method string getUserId()
 * @method string getItemId()
 * @method string getInstanceId()
 * @method string getItemType()
 * @method string getCmdType()
 * @method string getSceneId()
 * @method string getBhvType()
 * @method string getTable()
 */
class QueryDataMessageStatistics extends Roa
{
    /** @var string */
    public $pathPattern = '/v2/openapi/instances/[instanceId]/tables/[table]/data-message-statistics';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTraceId($value)
    {
        $this->data['TraceId'] = $value;
        $this->options['query']['traceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMessageSource($value)
    {
        $this->data['MessageSource'] = $value;
        $this->options['query']['messageSource'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndTime($value)
    {
        $this->data['EndTime'] = $value;
        $this->options['query']['endTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUserType($value)
    {
        $this->data['UserType'] = $value;
        $this->options['query']['userType'] = $value;

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
    public function withUserId($value)
    {
        $this->data['UserId'] = $value;
        $this->options['query']['userId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withItemId($value)
    {
        $this->data['ItemId'] = $value;
        $this->options['query']['itemId'] = $value;

        return $this;
    }

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withItemType($value)
    {
        $this->data['ItemType'] = $value;
        $this->options['query']['itemType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCmdType($value)
    {
        $this->data['CmdType'] = $value;
        $this->options['query']['cmdType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSceneId($value)
    {
        $this->data['SceneId'] = $value;
        $this->options['query']['sceneId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBhvType($value)
    {
        $this->data['BhvType'] = $value;
        $this->options['query']['bhvType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTable($value)
    {
        $this->data['Table'] = $value;
        $this->pathParameters['table'] = $value;

        return $this;
    }
}
