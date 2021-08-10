<?php

namespace AlibabaCloud\Slb;

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getHealthCheckTimeout()
 * @method $this withHealthCheckTimeout($value)
 * @method string getXForwardedFor()
 * @method $this withXForwardedFor($value)
 * @method string getHealthCheckURI()
 * @method $this withHealthCheckURI($value)
 * @method string getXForwardedForSLBPORT()
 * @method string getAclStatus()
 * @method $this withAclStatus($value)
 * @method string getAclType()
 * @method $this withAclType($value)
 * @method string getHealthCheck()
 * @method $this withHealthCheck($value)
 * @method string getVpcIds()
 * @method $this withVpcIds($value)
 * @method string getVServerGroupId()
 * @method $this withVServerGroupId($value)
 * @method string getAclId()
 * @method $this withAclId($value)
 * @method string getForwardCode()
 * @method $this withForwardCode($value)
 * @method string getCookie()
 * @method $this withCookie($value)
 * @method string getHealthCheckMethod()
 * @method $this withHealthCheckMethod($value)
 * @method string getHealthCheckDomain()
 * @method $this withHealthCheckDomain($value)
 * @method string getRequestTimeout()
 * @method $this withRequestTimeout($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTags()
 * @method $this withTags($value)
 * @method string getLoadBalancerId()
 * @method $this withLoadBalancerId($value)
 * @method string getXForwardedForSLBIP()
 * @method string getHealthCheckInterval()
 * @method $this withHealthCheckInterval($value)
 * @method string getXForwardedForSLBID()
 * @method string getAccessKeyId()
 * @method string getXForwardedForCLientSrcPort()
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getUnhealthyThreshold()
 * @method $this withUnhealthyThreshold($value)
 * @method string getHealthyThreshold()
 * @method $this withHealthyThreshold($value)
 * @method string getScheduler()
 * @method $this withScheduler($value)
 * @method string getMaxConnection()
 * @method $this withMaxConnection($value)
 * @method string getCookieTimeout()
 * @method $this withCookieTimeout($value)
 * @method string getStickySessionType()
 * @method $this withStickySessionType($value)
 * @method string getListenerPort()
 * @method $this withListenerPort($value)
 * @method string getHealthCheckType()
 * @method $this withHealthCheckType($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBandwidth()
 * @method $this withBandwidth($value)
 * @method string getStickySession()
 * @method $this withStickySession($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getGzip()
 * @method $this withGzip($value)
 * @method string getIdleTimeout()
 * @method $this withIdleTimeout($value)
 * @method string getXForwardedForProto()
 * @method string getHealthCheckConnectPort()
 * @method $this withHealthCheckConnectPort($value)
 * @method string getHealthCheckHttpCode()
 * @method $this withHealthCheckHttpCode($value)
 * @method string getVServerGroup()
 * @method $this withVServerGroup($value)
 */
class SetLoadBalancerHTTPListenerAttribute extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withXForwardedForSLBPORT($value)
    {
        $this->data['XForwardedForSLBPORT'] = $value;
        $this->options['query']['XForwardedFor_SLBPORT'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withXForwardedForSLBIP($value)
    {
        $this->data['XForwardedForSLBIP'] = $value;
        $this->options['query']['XForwardedFor_SLBIP'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withXForwardedForSLBID($value)
    {
        $this->data['XForwardedForSLBID'] = $value;
        $this->options['query']['XForwardedFor_SLBID'] = $value;

        return $this;
    }

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

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withXForwardedForCLientSrcPort($value)
    {
        $this->data['XForwardedForCLientSrcPort'] = $value;
        $this->options['query']['XForwardedFor_ClientSrcPort'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withXForwardedForProto($value)
    {
        $this->data['XForwardedForProto'] = $value;
        $this->options['query']['XForwardedFor_proto'] = $value;

        return $this;
    }
}
