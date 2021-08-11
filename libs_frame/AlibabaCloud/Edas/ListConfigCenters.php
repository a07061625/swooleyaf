<?php

namespace AlibabaCloud\Edas;

/**
 * @method string getAppName()
 * @method string getLogicalRegionId()
 * @method string getDataIdPattern()
 * @method string getGroup()
 */
class ListConfigCenters extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v5/configCenters';

    /** @var string */
    public $method = 'GET';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppName($value)
    {
        $this->data['AppName'] = $value;
        $this->options['query']['AppName'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDataIdPattern($value)
    {
        $this->data['DataIdPattern'] = $value;
        $this->options['query']['DataIdPattern'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withGroup($value)
    {
        $this->data['Group'] = $value;
        $this->options['query']['Group'] = $value;

        return $this;
    }
}
