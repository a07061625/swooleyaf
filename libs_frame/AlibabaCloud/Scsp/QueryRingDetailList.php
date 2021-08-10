<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getFromPhoneNumList()
 * @method string getCallOutStatus()
 * @method string getStartDate()
 * @method string getEndDate()
 * @method string getInstanceId()
 * @method string getPageNo()
 * @method string getExtra()
 * @method string getPageSize()
 * @method string getToPhoneNumList()
 */
class QueryRingDetailList extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFromPhoneNumList($value)
    {
        $this->data['FromPhoneNumList'] = $value;
        $this->options['form_params']['FromPhoneNumList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCallOutStatus($value)
    {
        $this->data['CallOutStatus'] = $value;
        $this->options['form_params']['CallOutStatus'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withStartDate($value)
    {
        $this->data['StartDate'] = $value;
        $this->options['form_params']['StartDate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEndDate($value)
    {
        $this->data['EndDate'] = $value;
        $this->options['form_params']['EndDate'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInstanceId($value)
    {
        $this->data['InstanceId'] = $value;
        $this->options['form_params']['InstanceId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNo($value)
    {
        $this->data['PageNo'] = $value;
        $this->options['form_params']['PageNo'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtra($value)
    {
        $this->data['Extra'] = $value;
        $this->options['form_params']['Extra'] = $value;

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withToPhoneNumList($value)
    {
        $this->data['ToPhoneNumList'] = $value;
        $this->options['form_params']['ToPhoneNumList'] = $value;

        return $this;
    }
}
