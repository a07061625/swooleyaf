<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getLogicalRegionId()
 */
class ListCluster extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/resource/cluster_list';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withLogicalRegionId($value)
    {
        $this->data['LogicalRegionId'] = $value;
        $this->options['query']['LogicalRegionId'] = $value;

        return $this;
    }
}
