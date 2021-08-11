<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getResourceType()
 * @method string getTags()
 * @method string getResourceIds()
 */
class TagResources extends Roa
{
    /** @var string */
    public $pathPattern = '/tags';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withResourceType($value)
    {
        $this->data['ResourceType'] = $value;
        $this->options['form_params']['ResourceType'] = $value;

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
        $this->options['form_params']['Tags'] = $value;

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
        $this->options['form_params']['ResourceIds'] = $value;

        return $this;
    }
}
