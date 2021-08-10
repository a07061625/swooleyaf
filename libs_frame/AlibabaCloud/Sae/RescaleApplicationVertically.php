<?php

namespace AlibabaCloud\Sae;

/**
 * @method string getMemory()
 * @method string getAppId()
 * @method string getCpu()
 */
class RescaleApplicationVertically extends Roa
{
    /** @var string */
    public $pathPattern = '/pop/v1/sam/app/rescaleApplicationVertically';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMemory($value)
    {
        $this->data['Memory'] = $value;
        $this->options['query']['Memory'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['query']['AppId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCpu($value)
    {
        $this->data['Cpu'] = $value;
        $this->options['query']['Cpu'] = $value;

        return $this;
    }
}
