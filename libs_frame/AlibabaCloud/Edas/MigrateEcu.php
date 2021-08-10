<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getInstanceIds()
 * @method string getLogicalRegionId()
 */
class MigrateEcu extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/resource/migrate_ecu';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceIds($value)
    {
        $this->data['InstanceIds'] = $value;
        $this->options['query']['InstanceIds'] = $value;

        return $this;
    }

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
