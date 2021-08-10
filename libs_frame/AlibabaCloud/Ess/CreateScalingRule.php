<?php

namespace AlibabaCloud\Ess;

/**
 * @method array getStepAdjustment()
 * @method string getScalingGroupId()
 * @method $this withScalingGroupId($value)
 * @method string getDisableScaleIn()
 * @method $this withDisableScaleIn($value)
 * @method string getInitialMaxSize()
 * @method $this withInitialMaxSize($value)
 * @method string getScalingRuleName()
 * @method $this withScalingRuleName($value)
 * @method string getCooldown()
 * @method $this withCooldown($value)
 * @method string getPredictiveValueBehavior()
 * @method $this withPredictiveValueBehavior($value)
 * @method string getScaleInEvaluationCount()
 * @method $this withScaleInEvaluationCount($value)
 * @method string getScalingRuleType()
 * @method $this withScalingRuleType($value)
 * @method string getMetricName()
 * @method $this withMetricName($value)
 * @method string getPredictiveScalingMode()
 * @method $this withPredictiveScalingMode($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getAdjustmentValue()
 * @method $this withAdjustmentValue($value)
 * @method string getEstimatedInstanceWarmup()
 * @method $this withEstimatedInstanceWarmup($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getPredictiveTaskBufferTime()
 * @method $this withPredictiveTaskBufferTime($value)
 * @method string getAdjustmentType()
 * @method $this withAdjustmentType($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getPredictiveValueBuffer()
 * @method $this withPredictiveValueBuffer($value)
 * @method string getScaleOutEvaluationCount()
 * @method $this withScaleOutEvaluationCount($value)
 * @method string getMinAdjustmentMagnitude()
 * @method $this withMinAdjustmentMagnitude($value)
 * @method string getTargetValue()
 * @method $this withTargetValue($value)
 */
class CreateScalingRule extends Rpc
{
    /**
     * @return $this
     */
    public function withStepAdjustment(array $stepAdjustment)
    {
        $this->data['StepAdjustment'] = $stepAdjustment;
        foreach ($stepAdjustment as $depth1 => $depth1Value) {
            if (isset($depth1Value['MetricIntervalLowerBound'])) {
                $this->options['query']['StepAdjustment.' . ($depth1 + 1) . '.MetricIntervalLowerBound'] = $depth1Value['MetricIntervalLowerBound'];
            }
            if (isset($depth1Value['MetricIntervalUpperBound'])) {
                $this->options['query']['StepAdjustment.' . ($depth1 + 1) . '.MetricIntervalUpperBound'] = $depth1Value['MetricIntervalUpperBound'];
            }
            if (isset($depth1Value['ScalingAdjustment'])) {
                $this->options['query']['StepAdjustment.' . ($depth1 + 1) . '.ScalingAdjustment'] = $depth1Value['ScalingAdjustment'];
            }
        }

        return $this;
    }
}
