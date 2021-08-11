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
 * @method string getTenant()
 */
class ModifyTenantInfo extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTenant($value)
    {
        $this->data['Tenant'] = $value;
        $this->options['form_params']['Tenant'] = $value;

        return $this;
    }
}
