<?php

namespace AlibabaCloud\MPaaS;

/**
 * @method string getTaskName()
 * @method string getTitle()
 * @method string getContent()
 * @method string getPushAction()
 * @method string getDeliveryType()
 * @method string getNotifyType()
 * @method string getTargetMsgkey()
 * @method string getExtendedParams()
 * @method string getSilent()
 * @method string getUri()
 * @method string getExpiredSeconds()
 * @method string getAppId()
 * @method string getWorkspaceId()
 */
class PushSimple extends Rpc
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
    public function withTitle($value)
    {
        $this->data['Title'] = $value;
        $this->options['form_params']['Title'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withContent($value)
    {
        $this->data['Content'] = $value;
        $this->options['form_params']['Content'] = $value;

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
    public function withTargetMsgkey($value)
    {
        $this->data['TargetMsgkey'] = $value;
        $this->options['form_params']['TargetMsgkey'] = $value;

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
    public function withUri($value)
    {
        $this->data['Uri'] = $value;
        $this->options['form_params']['Uri'] = $value;

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
    public function withWorkspaceId($value)
    {
        $this->data['WorkspaceId'] = $value;
        $this->options['form_params']['WorkspaceId'] = $value;

        return $this;
    }
}
