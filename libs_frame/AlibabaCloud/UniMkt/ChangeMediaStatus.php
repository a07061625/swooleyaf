<?php

namespace AlibabaCloud\UniMkt;

/**
 * @method string getMessageKey()
 * @method string getBusiness()
 * @method $this withBusiness($value)
 * @method string getMediaId()
 * @method string getMediaStatus()
 * @method string getMessage()
 * @method string getUserId()
 * @method $this withUserId($value)
 * @method string getOriginSiteUserId()
 * @method $this withOriginSiteUserId($value)
 * @method string getEnvironment()
 * @method $this withEnvironment($value)
 * @method string getAppName()
 * @method $this withAppName($value)
 * @method string getTenantId()
 * @method $this withTenantId($value)
 * @method string getUserSite()
 * @method $this withUserSite($value)
 * @method string getAccessStatus()
 */
class ChangeMediaStatus extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMessageKey($value)
    {
        $this->data['MessageKey'] = $value;
        $this->options['form_params']['MessageKey'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMediaId($value)
    {
        $this->data['MediaId'] = $value;
        $this->options['form_params']['MediaId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMediaStatus($value)
    {
        $this->data['MediaStatus'] = $value;
        $this->options['form_params']['MediaStatus'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMessage($value)
    {
        $this->data['Message'] = $value;
        $this->options['form_params']['Message'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccessStatus($value)
    {
        $this->data['AccessStatus'] = $value;
        $this->options['form_params']['AccessStatus'] = $value;

        return $this;
    }
}
