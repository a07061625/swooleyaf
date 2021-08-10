<?php

namespace AlibabaCloud\CDRS;

/**
 * @method string getCorpId()
 * @method string getDescription()
 * @method string getRuleName()
 * @method string getPicOperateType()
 * @method string getAttributeName()
 * @method string getAttributeOperateType()
 * @method string getRuleExpression()
 * @method string getNotifierTimeOut()
 * @method string getTaskId()
 * @method string getDeviceOperateType()
 * @method string getPicList()
 * @method string getAttributeValueList()
 * @method string getNotifierAppSecret()
 * @method string getNotifierExtendValues()
 * @method string getDeviceList()
 * @method string getNotifierUrl()
 * @method string getNotifierType()
 * @method string getPicExtendList()
 * @method string getBizId()
 * @method string getAlgorithmVendor()
 */
class UpdateMonitor extends Rpc
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
    public function withRuleName($value)
    {
        $this->data['RuleName'] = $value;
        $this->options['form_params']['RuleName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPicOperateType($value)
    {
        $this->data['PicOperateType'] = $value;
        $this->options['form_params']['PicOperateType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAttributeName($value)
    {
        $this->data['AttributeName'] = $value;
        $this->options['form_params']['AttributeName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAttributeOperateType($value)
    {
        $this->data['AttributeOperateType'] = $value;
        $this->options['form_params']['AttributeOperateType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRuleExpression($value)
    {
        $this->data['RuleExpression'] = $value;
        $this->options['form_params']['RuleExpression'] = $value;

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
    public function withTaskId($value)
    {
        $this->data['TaskId'] = $value;
        $this->options['form_params']['TaskId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeviceOperateType($value)
    {
        $this->data['DeviceOperateType'] = $value;
        $this->options['form_params']['DeviceOperateType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPicList($value)
    {
        $this->data['PicList'] = $value;
        $this->options['form_params']['PicList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAttributeValueList($value)
    {
        $this->data['AttributeValueList'] = $value;
        $this->options['form_params']['AttributeValueList'] = $value;

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
    public function withDeviceList($value)
    {
        $this->data['DeviceList'] = $value;
        $this->options['form_params']['DeviceList'] = $value;

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
    public function withPicExtendList($value)
    {
        $this->data['PicExtendList'] = $value;
        $this->options['form_params']['PicExtendList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBizId($value)
    {
        $this->data['BizId'] = $value;
        $this->options['form_params']['BizId'] = $value;

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
