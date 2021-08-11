<?php

namespace AlibabaCloud\Dts;

/**
 * @method string getSourceEndpointInstanceID()
 * @method string getSourceEndpointOracleSID()
 * @method string getSourceEndpointIP()
 * @method string getSubscriptionDataTypeDML()
 * @method string getSourceEndpointInstanceType()
 * @method string getAccountId()
 * @method $this withAccountId($value)
 * @method string getSubscriptionObject()
 * @method string getSubscriptionInstanceVSwitchId()
 * @method string getSourceEndpointUserName()
 * @method string getSourceEndpointDatabaseName()
 * @method string getSourceEndpointPort()
 * @method string getSourceEndpointOwnerID()
 * @method string getSubscriptionInstanceVPCId()
 * @method string getSubscriptionInstanceNetworkType()
 * @method $this withSubscriptionInstanceNetworkType($value)
 * @method string getSubscriptionInstanceId()
 * @method $this withSubscriptionInstanceId($value)
 * @method string getSourceEndpointRole()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getSubscriptionDataTypeDDL()
 * @method string getSourceEndpointPassword()
 * @method string getSubscriptionInstanceName()
 * @method $this withSubscriptionInstanceName($value)
 */
class ConfigureSubscriptionInstance extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceEndpointInstanceID($value)
    {
        $this->data['SourceEndpointInstanceID'] = $value;
        $this->options['query']['SourceEndpoint.InstanceID'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceEndpointOracleSID($value)
    {
        $this->data['SourceEndpointOracleSID'] = $value;
        $this->options['query']['SourceEndpoint.OracleSID'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceEndpointIP($value)
    {
        $this->data['SourceEndpointIP'] = $value;
        $this->options['query']['SourceEndpoint.IP'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSubscriptionDataTypeDML($value)
    {
        $this->data['SubscriptionDataTypeDML'] = $value;
        $this->options['query']['SubscriptionDataType.DML'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceEndpointInstanceType($value)
    {
        $this->data['SourceEndpointInstanceType'] = $value;
        $this->options['query']['SourceEndpoint.InstanceType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSubscriptionObject($value)
    {
        $this->data['SubscriptionObject'] = $value;
        $this->options['form_params']['SubscriptionObject'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSubscriptionInstanceVSwitchId($value)
    {
        $this->data['SubscriptionInstanceVSwitchId'] = $value;
        $this->options['query']['SubscriptionInstance.VSwitchId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceEndpointUserName($value)
    {
        $this->data['SourceEndpointUserName'] = $value;
        $this->options['query']['SourceEndpoint.UserName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceEndpointDatabaseName($value)
    {
        $this->data['SourceEndpointDatabaseName'] = $value;
        $this->options['query']['SourceEndpoint.DatabaseName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceEndpointPort($value)
    {
        $this->data['SourceEndpointPort'] = $value;
        $this->options['query']['SourceEndpoint.Port'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceEndpointOwnerID($value)
    {
        $this->data['SourceEndpointOwnerID'] = $value;
        $this->options['query']['SourceEndpoint.OwnerID'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSubscriptionInstanceVPCId($value)
    {
        $this->data['SubscriptionInstanceVPCId'] = $value;
        $this->options['query']['SubscriptionInstance.VPCId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceEndpointRole($value)
    {
        $this->data['SourceEndpointRole'] = $value;
        $this->options['query']['SourceEndpoint.Role'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSubscriptionDataTypeDDL($value)
    {
        $this->data['SubscriptionDataTypeDDL'] = $value;
        $this->options['query']['SubscriptionDataType.DDL'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceEndpointPassword($value)
    {
        $this->data['SourceEndpointPassword'] = $value;
        $this->options['query']['SourceEndpoint.Password'] = $value;

        return $this;
    }
}
