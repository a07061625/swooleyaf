<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getTaskName()
 * @method string getPushAction()
 * @method string getDeliveryType()
 * @method string getTemplateName()
 * @method string getNotifyType()
 * @method string getExtendedParams()
 * @method string getSilent()
 * @method string getExpiredSeconds()
 * @method array getTargetMsg()
 * @method string getAppId()
 * @method string getWorkspaceId()
 */
class PushMultiple extends Rpc
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
    public function withExpiredSeconds($value)
    {
        $this->data['ExpiredSeconds'] = $value;
        $this->options['form_params']['ExpiredSeconds'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withTargetMsg(array $targetMsg)
    {
        $this->data['TargetMsg'] = $targetMsg;
        foreach ($targetMsg as $depth1 => $depth1Value) {
            if (isset($depth1Value['ExtendedParams'])) {
                $this->options['form_params']['TargetMsg.' . ($depth1 + 1) . '.ExtendedParams'] = $depth1Value['ExtendedParams'];
            }
            if (isset($depth1Value['TemplateKeyValue'])) {
                $this->options['form_params']['TargetMsg.' . ($depth1 + 1) . '.TemplateKeyValue'] = $depth1Value['TemplateKeyValue'];
            }
            if (isset($depth1Value['MsgKey'])) {
                $this->options['form_params']['TargetMsg.' . ($depth1 + 1) . '.MsgKey'] = $depth1Value['MsgKey'];
            }
            if (isset($depth1Value['Target'])) {
                $this->options['form_params']['TargetMsg.' . ($depth1 + 1) . '.Target'] = $depth1Value['Target'];
            }
        }

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
    public function withWorkspaceId($value)
    {
        $this->data['WorkspaceId'] = $value;
        $this->options['form_params']['WorkspaceId'] = $value;

        return $this;
    }
}
