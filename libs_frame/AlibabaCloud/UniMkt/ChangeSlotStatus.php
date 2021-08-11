<?php

namespace AlibabaCloud\UniMkt;

/**
 * @method string getMessageKey()
 * @method string getBusiness()
 * @method $this withBusiness($value)
 * @method string getMessage()
 * @method string getUserId()
 * @method $this withUserId($value)
 * @method string getOriginSiteUserId()
 * @method $this withOriginSiteUserId($value)
 * @method string getEnvironment()
 * @method $this withEnvironment($value)
 * @method string getAppName()
 * @method $this withAppName($value)
 * @method string getAdSlotStatus()
 * @method string getTenantId()
 * @method $this withTenantId($value)
 * @method string getAdSlotId()
 * @method string getUserSite()
 * @method $this withUserSite($value)
 * @method string getAdSlotCorporateStatus()
 */
class ChangeSlotStatus extends Rpc
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
    public function withAdSlotStatus($value)
    {
        $this->data['AdSlotStatus'] = $value;
        $this->options['form_params']['AdSlotStatus'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAdSlotId($value)
    {
        $this->data['AdSlotId'] = $value;
        $this->options['form_params']['AdSlotId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAdSlotCorporateStatus($value)
    {
        $this->data['AdSlotCorporateStatus'] = $value;
        $this->options['form_params']['AdSlotCorporateStatus'] = $value;

        return $this;
    }
}
