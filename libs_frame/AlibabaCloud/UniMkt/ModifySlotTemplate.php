<?php

namespace AlibabaCloud\UniMkt;

/**
 * @method string getBusiness()
 * @method $this withBusiness($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getUserId()
 * @method $this withUserId($value)
 * @method string getOriginSiteUserId()
 * @method $this withOriginSiteUserId($value)
 * @method string getAdSlotTemplate()
 * @method string getEnvironment()
 * @method $this withEnvironment($value)
 * @method string getAppName()
 * @method $this withAppName($value)
 * @method string getTenantId()
 * @method $this withTenantId($value)
 * @method string getUserSite()
 * @method $this withUserSite($value)
 */
class ModifySlotTemplate extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAdSlotTemplate($value)
    {
        $this->data['AdSlotTemplate'] = $value;
        $this->options['form_params']['AdSlotTemplate'] = $value;

        return $this;
    }
}
