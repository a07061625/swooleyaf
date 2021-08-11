<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getReason()
 * @method string getObjectKind()
 * @method string getAppId()
 * @method string getPageSize()
 * @method string getObjectName()
 * @method string getNamespace()
 * @method string getCurrentPage()
 * @method string getEventType()
 */
class ListAppEvents extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/app/listAppEvents';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withReason($value)
    {
        $this->data['Reason'] = $value;
        $this->options['query']['Reason'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withObjectKind($value)
    {
        $this->data['ObjectKind'] = $value;
        $this->options['query']['ObjectKind'] = $value;

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
        $this->options['query']['AppId'] = $value;

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
        $this->options['query']['PageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withObjectName($value)
    {
        $this->data['ObjectName'] = $value;
        $this->options['query']['ObjectName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNamespace($value)
    {
        $this->data['Namespace'] = $value;
        $this->options['query']['Namespace'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCurrentPage($value)
    {
        $this->data['CurrentPage'] = $value;
        $this->options['query']['CurrentPage'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEventType($value)
    {
        $this->data['EventType'] = $value;
        $this->options['query']['EventType'] = $value;

        return $this;
    }
}
