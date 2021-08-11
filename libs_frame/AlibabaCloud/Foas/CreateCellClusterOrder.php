<?php

namespace AlibabaCloud\Foas;

/**
 * @method string getPeriod()
 * @method string getSlaveNum()
 * @method string getSlaveSpec()
 * @method string getRegion()
 * @method string getMasterNum()
 * @method string getMasterSpec()
 * @method string getPayModel()
 */
class CreateCellClusterOrder extends Roa
{
    /** @var string */
    public $pathPattern = '/api/v2/realtime-compute/cell/buy';

    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPeriod($value)
    {
        $this->data['Period'] = $value;
        $this->options['form_params']['period'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSlaveNum($value)
    {
        $this->data['SlaveNum'] = $value;
        $this->options['form_params']['slaveNum'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSlaveSpec($value)
    {
        $this->data['SlaveSpec'] = $value;
        $this->options['form_params']['slaveSpec'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRegion($value)
    {
        $this->data['Region'] = $value;
        $this->options['form_params']['region'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMasterNum($value)
    {
        $this->data['MasterNum'] = $value;
        $this->options['form_params']['masterNum'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMasterSpec($value)
    {
        $this->data['MasterSpec'] = $value;
        $this->options['form_params']['masterSpec'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPayModel($value)
    {
        $this->data['PayModel'] = $value;
        $this->options['form_params']['payModel'] = $value;

        return $this;
    }
}
