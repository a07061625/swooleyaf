<?php

namespace AlibabaCloud\UniMkt;

/**
 * @method string getAdRule()
 * @method string getBusiness()
 * @method $this withBusiness($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
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
 */
class CreateRule extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAdRule($value)
    {
        $this->data['AdRule'] = $value;
        $this->options['form_params']['AdRule'] = $value;

        return $this;
    }
}
