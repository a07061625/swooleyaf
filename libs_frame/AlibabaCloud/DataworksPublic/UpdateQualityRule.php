<?php

namespace AlibabaCloud\DataworksPublic;

/**
 * @method string getTrend()
 * @method string getBlockType()
 * @method string getPropertyType()
 * @method string getEntityId()
 * @method string getRuleName()
 * @method string getChecker()
 * @method string getOperator()
 * @method string getProperty()
 * @method string getId()
 * @method string getWarningThreshold()
 * @method string getMethodName()
 * @method string getProjectName()
 * @method string getRuleType()
 * @method string getTemplateId()
 * @method string getExpectValue()
 * @method string getWhereCondition()
 * @method string getCriticalThreshold()
 * @method string getComment()
 * @method string getPredictType()
 */
class UpdateQualityRule extends Rpc
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTrend($value)
    {
        $this->data['Trend'] = $value;
        $this->options['form_params']['Trend'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withBlockType($value)
    {
        $this->data['BlockType'] = $value;
        $this->options['form_params']['BlockType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPropertyType($value)
    {
        $this->data['PropertyType'] = $value;
        $this->options['form_params']['PropertyType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEntityId($value)
    {
        $this->data['EntityId'] = $value;
        $this->options['form_params']['EntityId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRuleName($value)
    {
        $this->data['RuleName'] = $value;
        $this->options['form_params']['RuleName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withChecker($value)
    {
        $this->data['Checker'] = $value;
        $this->options['form_params']['Checker'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withOperator($value)
    {
        $this->data['Operator'] = $value;
        $this->options['form_params']['Operator'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProperty($value)
    {
        $this->data['Property'] = $value;
        $this->options['form_params']['Property'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withId($value)
    {
        $this->data['Id'] = $value;
        $this->options['form_params']['Id'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWarningThreshold($value)
    {
        $this->data['WarningThreshold'] = $value;
        $this->options['form_params']['WarningThreshold'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withMethodName($value)
    {
        $this->data['MethodName'] = $value;
        $this->options['form_params']['MethodName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProjectName($value)
    {
        $this->data['ProjectName'] = $value;
        $this->options['form_params']['ProjectName'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withRuleType($value)
    {
        $this->data['RuleType'] = $value;
        $this->options['form_params']['RuleType'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTemplateId($value)
    {
        $this->data['TemplateId'] = $value;
        $this->options['form_params']['TemplateId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withExpectValue($value)
    {
        $this->data['ExpectValue'] = $value;
        $this->options['form_params']['ExpectValue'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWhereCondition($value)
    {
        $this->data['WhereCondition'] = $value;
        $this->options['form_params']['WhereCondition'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withCriticalThreshold($value)
    {
        $this->data['CriticalThreshold'] = $value;
        $this->options['form_params']['CriticalThreshold'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withComment($value)
    {
        $this->data['Comment'] = $value;
        $this->options['form_params']['Comment'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPredictType($value)
    {
        $this->data['PredictType'] = $value;
        $this->options['form_params']['PredictType'] = $value;

        return $this;
    }
}
