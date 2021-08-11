<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getSrType()
 * @method string getTouchId()
 * @method string getDealId()
 * @method string getCurrentPage()
 * @method string getTaskStatus()
 * @method string getInstanceId()
 * @method string getAccountName()
 * @method string getCaseId()
 * @method string getExtra()
 * @method string getChannelType()
 * @method string getPageSize()
 * @method string getCaseType()
 * @method string getCaseStatus()
 * @method string getChannelId()
 */
class QueryTickets extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSrType($value)
    {
        $this->data['SrType'] = $value;
        $this->options['form_params']['SrType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTouchId($value)
    {
        $this->data['TouchId'] = $value;
        $this->options['form_params']['TouchId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDealId($value)
    {
        $this->data['DealId'] = $value;
        $this->options['form_params']['DealId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCurrentPage($value)
    {
        $this->data['CurrentPage'] = $value;
        $this->options['form_params']['CurrentPage'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskStatus($value)
    {
        $this->data['TaskStatus'] = $value;
        $this->options['form_params']['TaskStatus'] = $value;

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
    public function withAccountName($value)
    {
        $this->data['AccountName'] = $value;
        $this->options['form_params']['AccountName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCaseId($value)
    {
        $this->data['CaseId'] = $value;
        $this->options['form_params']['CaseId'] = $value;

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
    public function withChannelType($value)
    {
        $this->data['ChannelType'] = $value;
        $this->options['form_params']['ChannelType'] = $value;

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
    public function withCaseType($value)
    {
        $this->data['CaseType'] = $value;
        $this->options['form_params']['CaseType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCaseStatus($value)
    {
        $this->data['CaseStatus'] = $value;
        $this->options['form_params']['CaseStatus'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withChannelId($value)
    {
        $this->data['ChannelId'] = $value;
        $this->options['form_params']['ChannelId'] = $value;

        return $this;
    }
}
