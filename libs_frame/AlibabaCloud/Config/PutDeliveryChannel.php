<?php

namespace AlibabaCloud\Config;

/**
 * @method string getClientToken()
 * @method string getDescription()
 * @method string getDeliveryChannelTargetArn()
 * @method string getDeliveryChannelCondition()
 * @method string getDeliveryChannelAssumeRoleArn()
 * @method string getDeliveryChannelName()
 * @method string getDeliveryChannelId()
 * @method string getDeliveryChannelType()
 * @method string getStatus()
 */
class PutDeliveryChannel extends Rpc
{
    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['form_params']['ClientToken'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['form_params']['Description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeliveryChannelTargetArn($value)
    {
        $this->data['DeliveryChannelTargetArn'] = $value;
        $this->options['form_params']['DeliveryChannelTargetArn'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeliveryChannelCondition($value)
    {
        $this->data['DeliveryChannelCondition'] = $value;
        $this->options['form_params']['DeliveryChannelCondition'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeliveryChannelAssumeRoleArn($value)
    {
        $this->data['DeliveryChannelAssumeRoleArn'] = $value;
        $this->options['form_params']['DeliveryChannelAssumeRoleArn'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeliveryChannelName($value)
    {
        $this->data['DeliveryChannelName'] = $value;
        $this->options['form_params']['DeliveryChannelName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeliveryChannelId($value)
    {
        $this->data['DeliveryChannelId'] = $value;
        $this->options['form_params']['DeliveryChannelId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeliveryChannelType($value)
    {
        $this->data['DeliveryChannelType'] = $value;
        $this->options['form_params']['DeliveryChannelType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStatus($value)
    {
        $this->data['Status'] = $value;
        $this->options['form_params']['Status'] = $value;

        return $this;
    }
}
