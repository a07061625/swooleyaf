<?php

namespace AlibabaCloud\Vcs;

/**
 * @method string getMonitorType()
 * @method string getCorpId()
 * @method string getDescription()
 * @method string getNotifierAppSecret()
 * @method string getNotifierExtendValues()
 * @method string getNotifierUrl()
 * @method string getNotifierType()
 * @method string getBatchIndicator()
 * @method string getNotifierTimeOut()
 * @method string getAlgorithmVendor()
 */
class AddMonitor extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMonitorType($value)
    {
        $this->data['MonitorType'] = $value;
        $this->options['form_params']['MonitorType'] = $value;

        return $this;
    }

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
    public function withNotifierAppSecret($value)
    {
        $this->data['NotifierAppSecret'] = $value;
        $this->options['form_params']['NotifierAppSecret'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNotifierExtendValues($value)
    {
        $this->data['NotifierExtendValues'] = $value;
        $this->options['form_params']['NotifierExtendValues'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNotifierUrl($value)
    {
        $this->data['NotifierUrl'] = $value;
        $this->options['form_params']['NotifierUrl'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNotifierType($value)
    {
        $this->data['NotifierType'] = $value;
        $this->options['form_params']['NotifierType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBatchIndicator($value)
    {
        $this->data['BatchIndicator'] = $value;
        $this->options['form_params']['BatchIndicator'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNotifierTimeOut($value)
    {
        $this->data['NotifierTimeOut'] = $value;
        $this->options['form_params']['NotifierTimeOut'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAlgorithmVendor($value)
    {
        $this->data['AlgorithmVendor'] = $value;
        $this->options['form_params']['AlgorithmVendor'] = $value;

        return $this;
    }
}
