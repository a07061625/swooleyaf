<?php

namespace AlibabaCloud\Slb;

/**
 * @method string getAccessKeyId()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getHealthCheckTimeout()
 * @method $this withHealthCheckTimeout($value)
 * @method string getHealthCheckURI()
 * @method $this withHealthCheckURI($value)
 * @method string getRuleName()
 * @method $this withRuleName($value)
 * @method string getUnhealthyThreshold()
 * @method $this withUnhealthyThreshold($value)
 * @method string getHealthyThreshold()
 * @method $this withHealthyThreshold($value)
 * @method string getScheduler()
 * @method $this withScheduler($value)
 * @method string getHealthCheck()
 * @method $this withHealthCheck($value)
 * @method string getListenerSync()
 * @method $this withListenerSync($value)
 * @method string getCookieTimeout()
 * @method $this withCookieTimeout($value)
 * @method string getStickySessionType()
 * @method $this withStickySessionType($value)
 * @method string getVServerGroupId()
 * @method $this withVServerGroupId($value)
 * @method string getCookie()
 * @method $this withCookie($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getStickySession()
 * @method $this withStickySession($value)
 * @method string getHealthCheckDomain()
 * @method $this withHealthCheckDomain($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTags()
 * @method $this withTags($value)
 * @method string getHealthCheckInterval()
 * @method $this withHealthCheckInterval($value)
 * @method string getRuleId()
 * @method $this withRuleId($value)
 * @method string getHealthCheckConnectPort()
 * @method $this withHealthCheckConnectPort($value)
 * @method string getHealthCheckHttpCode()
 * @method $this withHealthCheckHttpCode($value)
 */
class SetRule extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withAccessKeyId($value)
    {
        $this->data['AccessKeyId'] = $value;
        $this->options['query']['access_key_id'] = $value;

        return $this;
    }
}
