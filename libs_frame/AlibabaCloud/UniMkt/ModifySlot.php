<?php

namespace AlibabaCloud\UniMkt;

/**
 * @method string getBusiness()
 * @method $this withBusiness($value)
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
 * @method string getAdSlot()
 */
class ModifySlot extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAdSlot($value)
    {
        $this->data['AdSlot'] = $value;
        $this->options['form_params']['AdSlot'] = $value;

        return $this;
    }
}
