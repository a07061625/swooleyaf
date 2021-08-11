<?php

namespace AlibabaCloud\Scsp;

/**
 * @method string getFromInfo()
 * @method string getClientToken()
 * @method string getCarbonCopy()
 * @method string getCreatorId()
 * @method string getBizData()
 * @method string getTemplateId()
 * @method string getPriority()
 * @method string getFormData()
 * @method string getInstanceId()
 * @method string getCreatorType()
 * @method string getCreatorName()
 * @method string getCategoryId()
 * @method string getMemberName()
 * @method string getMemberId()
 */
class CreateTicketWithBizData extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFromInfo($value)
    {
        $this->data['FromInfo'] = $value;
        $this->options['form_params']['FromInfo'] = $value;

        return $this;
    }

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
    public function withCarbonCopy($value)
    {
        $this->data['CarbonCopy'] = $value;
        $this->options['form_params']['CarbonCopy'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCreatorId($value)
    {
        $this->data['CreatorId'] = $value;
        $this->options['form_params']['CreatorId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizData($value)
    {
        $this->data['BizData'] = $value;
        $this->options['form_params']['BizData'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTemplateId($value)
    {
        $this->data['TemplateId'] = $value;
        $this->options['form_params']['TemplateId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPriority($value)
    {
        $this->data['Priority'] = $value;
        $this->options['form_params']['Priority'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFormData($value)
    {
        $this->data['FormData'] = $value;
        $this->options['form_params']['FormData'] = $value;

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
    public function withCreatorType($value)
    {
        $this->data['CreatorType'] = $value;
        $this->options['form_params']['CreatorType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCreatorName($value)
    {
        $this->data['CreatorName'] = $value;
        $this->options['form_params']['CreatorName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCategoryId($value)
    {
        $this->data['CategoryId'] = $value;
        $this->options['form_params']['CategoryId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMemberName($value)
    {
        $this->data['MemberName'] = $value;
        $this->options['form_params']['MemberName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMemberId($value)
    {
        $this->data['MemberId'] = $value;
        $this->options['form_params']['MemberId'] = $value;

        return $this;
    }
}
