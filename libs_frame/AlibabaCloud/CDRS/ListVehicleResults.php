<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getCorpId()
 * @method string getEndTime()
 * @method string getStartTime()
 * @method string getVehicleColor()
 * @method string getVehicleApplication()
 * @method string getPageNumber()
 * @method string getVehicleClass()
 * @method string getPageSize()
 */
class ListVehicleResults extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCorpId($value)
    {
        $this->data['CorpId'] = $value;
        $this->options['form_params']['CorpId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndTime($value)
    {
        $this->data['EndTime'] = $value;
        $this->options['form_params']['EndTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartTime($value)
    {
        $this->data['StartTime'] = $value;
        $this->options['form_params']['StartTime'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVehicleColor($value)
    {
        $this->data['VehicleColor'] = $value;
        $this->options['form_params']['VehicleColor'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVehicleApplication($value)
    {
        $this->data['VehicleApplication'] = $value;
        $this->options['form_params']['VehicleApplication'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNumber($value)
    {
        $this->data['PageNumber'] = $value;
        $this->options['form_params']['PageNumber'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVehicleClass($value)
    {
        $this->data['VehicleClass'] = $value;
        $this->options['form_params']['VehicleClass'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['form_params']['PageSize'] = $value;

        return $this;
    }
}
