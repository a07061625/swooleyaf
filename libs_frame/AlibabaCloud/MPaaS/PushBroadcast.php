<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getTaskName()
 * @method string getTemplateKeyValue()
 * @method string getPushAction()
 * @method string getDeliveryType()
 * @method string getTemplateName()
 * @method string getNotifyType()
 * @method string getExtendedParams()
 * @method string getSilent()
 * @method string getPushStatus()
 * @method string getUnBindPeriod()
 * @method string getExpiredSeconds()
 * @method string getAppId()
 * @method string getMsgkey()
 * @method string getWorkspaceId()
 */
class PushBroadcast extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTaskName($value)
    {
        $this->data['TaskName'] = $value;
        $this->options['form_params']['TaskName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTemplateKeyValue($value)
    {
        $this->data['TemplateKeyValue'] = $value;
        $this->options['form_params']['TemplateKeyValue'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPushAction($value)
    {
        $this->data['PushAction'] = $value;
        $this->options['form_params']['PushAction'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDeliveryType($value)
    {
        $this->data['DeliveryType'] = $value;
        $this->options['form_params']['DeliveryType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTemplateName($value)
    {
        $this->data['TemplateName'] = $value;
        $this->options['form_params']['TemplateName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNotifyType($value)
    {
        $this->data['NotifyType'] = $value;
        $this->options['form_params']['NotifyType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExtendedParams($value)
    {
        $this->data['ExtendedParams'] = $value;
        $this->options['form_params']['ExtendedParams'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSilent($value)
    {
        $this->data['Silent'] = $value;
        $this->options['form_params']['Silent'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPushStatus($value)
    {
        $this->data['PushStatus'] = $value;
        $this->options['form_params']['PushStatus'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withUnBindPeriod($value)
    {
        $this->data['UnBindPeriod'] = $value;
        $this->options['form_params']['UnBindPeriod'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExpiredSeconds($value)
    {
        $this->data['ExpiredSeconds'] = $value;
        $this->options['form_params']['ExpiredSeconds'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAppId($value)
    {
        $this->data['AppId'] = $value;
        $this->options['form_params']['AppId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMsgkey($value)
    {
        $this->data['Msgkey'] = $value;
        $this->options['form_params']['Msgkey'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWorkspaceId($value)
    {
        $this->data['WorkspaceId'] = $value;
        $this->options['form_params']['WorkspaceId'] = $value;

        return $this;
    }
}
