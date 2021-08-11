<?php

namespace AlibabaCloud\Objectdet;

/**
 * @method string getVinCodeImage()
 * @method string getCarNumberImage()
 * @method string getTaskId()
 */
class GetVehicleRepairPlan extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withVinCodeImage($value)
    {
        $this->data['VinCodeImage'] = $value;
        $this->options['form_params']['VinCodeImage'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCarNumberImage($value)
    {
        $this->data['CarNumberImage'] = $value;
        $this->options['form_params']['CarNumberImage'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskId($value)
    {
        $this->data['TaskId'] = $value;
        $this->options['form_params']['TaskId'] = $value;

        return $this;
    }
}
