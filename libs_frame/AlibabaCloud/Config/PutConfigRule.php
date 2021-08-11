<?php

namespace AlibabaCloud\Config;

/**
 * @method string getConfigRuleId()
 * @method string getMultiAccount()
 * @method $this withMultiAccount($value)
 * @method string getClientToken()
 * @method string getDescription()
 * @method string getSourceIdentifier()
 * @method string getSourceMaximumExecutionFrequency()
 * @method string getScopeComplianceResourceTypes()
 * @method string getSourceDetailMessageType()
 * @method string getRiskLevel()
 * @method string getSourceOwner()
 * @method string getInputParameters()
 * @method string getConfigRuleName()
 * @method string getScopeComplianceResourceId()
 * @method string getMemberId()
 * @method $this withMemberId($value)
 */
class PutConfigRule extends Rpc
{
    /** @var string */
    public $method = 'POST';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConfigRuleId($value)
    {
        $this->data['ConfigRuleId'] = $value;
        $this->options['form_params']['ConfigRuleId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withClientToken($value)
    {
        $this->data['ClientToken'] = $value;
        $this->options['form_params']['ClientToken'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDescription($value)
    {
        $this->data['Description'] = $value;
        $this->options['form_params']['Description'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceIdentifier($value)
    {
        $this->data['SourceIdentifier'] = $value;
        $this->options['form_params']['SourceIdentifier'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceMaximumExecutionFrequency($value)
    {
        $this->data['SourceMaximumExecutionFrequency'] = $value;
        $this->options['form_params']['SourceMaximumExecutionFrequency'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScopeComplianceResourceTypes($value)
    {
        $this->data['ScopeComplianceResourceTypes'] = $value;
        $this->options['form_params']['ScopeComplianceResourceTypes'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceDetailMessageType($value)
    {
        $this->data['SourceDetailMessageType'] = $value;
        $this->options['form_params']['SourceDetailMessageType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRiskLevel($value)
    {
        $this->data['RiskLevel'] = $value;
        $this->options['form_params']['RiskLevel'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withSourceOwner($value)
    {
        $this->data['SourceOwner'] = $value;
        $this->options['form_params']['SourceOwner'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withInputParameters($value)
    {
        $this->data['InputParameters'] = $value;
        $this->options['form_params']['InputParameters'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConfigRuleName($value)
    {
        $this->data['ConfigRuleName'] = $value;
        $this->options['form_params']['ConfigRuleName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withScopeComplianceResourceId($value)
    {
        $this->data['ScopeComplianceResourceId'] = $value;
        $this->options['form_params']['ScopeComplianceResourceId'] = $value;

        return $this;
    }
}
