<?php

namespace AlibabaCloud\Elasticsearch;

/**
 * @method string getEcsInstanceName()
 * @method string getEcsInstanceIds()
 * @method string getSize()
 * @method string getPage()
 * @method string getResId()
 * @method $this withResId($value)
 * @method string getTags()
 */
class ListNodes extends Roa
{
    /** @var string */
    public $pathPattern = '/openapi/collectors/[ResId]/nodes';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEcsInstanceName($value)
    {
        $this->data['EcsInstanceName'] = $value;
        $this->options['query']['ecsInstanceName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEcsInstanceIds($value)
    {
        $this->data['EcsInstanceIds'] = $value;
        $this->options['query']['ecsInstanceIds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSize($value)
    {
        $this->data['Size'] = $value;
        $this->options['query']['size'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPage($value)
    {
        $this->data['Page'] = $value;
        $this->options['query']['page'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTags($value)
    {
        $this->data['Tags'] = $value;
        $this->options['query']['tags'] = $value;

        return $this;
    }
}
