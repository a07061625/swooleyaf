<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getLogicalRegionId()
 */
class QueryMigrateEcuList extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/resource/migrate_ecu_list';

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
