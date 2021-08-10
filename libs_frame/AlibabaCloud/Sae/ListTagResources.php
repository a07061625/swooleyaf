<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getNextToken()
 * @method string getResourceType()
 * @method string getResourceIds()
 * @method string getTags()
 */
class ListTagResources extends Roa
{
    /** @var string */
    public $pathPattern = '/tags';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNextToken($value)
    {
        $this->data['NextToken'] = $value;
        $this->options['query']['NextToken'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withResourceType($value)
    {
        $this->data['ResourceType'] = $value;
        $this->options['query']['ResourceType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withResourceIds($value)
    {
        $this->data['ResourceIds'] = $value;
        $this->options['query']['ResourceIds'] = $value;

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
        $this->options['query']['Tags'] = $value;

        return $this;
    }
}
