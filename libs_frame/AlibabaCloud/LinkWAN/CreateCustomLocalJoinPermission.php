<?php

namespace AlibabaCloud\LinkWAN;

/**
 * @method string getClassMode()
 * @method string getFreqBandPlanGroupId()
 * @method string getJoinEui()
 * @method string getJoinPermissionName()
 */
class CreateCustomLocalJoinPermission extends Rpc
{
    /** @var string */
    public $scheme = 'http';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClassMode($value)
    {
        $this->data['ClassMode'] = $value;
        $this->options['form_params']['ClassMode'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFreqBandPlanGroupId($value)
    {
        $this->data['FreqBandPlanGroupId'] = $value;
        $this->options['form_params']['FreqBandPlanGroupId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJoinEui($value)
    {
        $this->data['JoinEui'] = $value;
        $this->options['form_params']['JoinEui'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withJoinPermissionName($value)
    {
        $this->data['JoinPermissionName'] = $value;
        $this->options['form_params']['JoinPermissionName'] = $value;

        return $this;
    }
}
