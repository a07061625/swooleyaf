<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getHybridCloudExclude()
 * @method string getContainCustom()
 */
class DescribeNamespaceList extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/namespace/describeNamespaceList';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withHybridCloudExclude($value)
    {
        $this->data['HybridCloudExclude'] = $value;
        $this->options['query']['HybridCloudExclude'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withContainCustom($value)
    {
        $this->data['ContainCustom'] = $value;
        $this->options['query']['ContainCustom'] = $value;

        return $this;
    }
}
