<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAct()
 * @method string getLogicalRegionId()
 */
class ListEcuByRegion extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/resource/ecu_list';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAct($value)
    {
        $this->data['Act'] = $value;
        $this->options['query']['Act'] = $value;

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
