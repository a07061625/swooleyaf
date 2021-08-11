<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getLogicalRegionId()
 */
class QueryMigrateRegionList extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/resource/migrate_region_select';

    /** @var string */
    public $method = 'GET';

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
