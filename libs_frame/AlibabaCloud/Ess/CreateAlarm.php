<?php

namespace AlibabaCloud\Ess;

/**
 * @method string getMetricType()
 * @method $this withMetricType($value)
 * @method string getScalingGroupId()
 * @method $this withScalingGroupId($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method array getAlarmAction()
 * @method string getThreshold()
 * @method $this withThreshold($value)
 * @method string getEffective()
 * @method $this withEffective($value)
 * @method string getEvaluationCount()
 * @method $this withEvaluationCount($value)
 * @method string getMetricName()
 * @method $this withMetricName($value)
 * @method array getDimension()
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getGroupId()
 * @method $this withGroupId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getName()
 * @method $this withName($value)
 * @method string getComparisonOperator()
 * @method $this withComparisonOperator($value)
 * @method string getStatistics()
 * @method $this withStatistics($value)
 */
class CreateAlarm extends Rpc
{
    /**
     * @return $this
     */
    public function withAlarmAction(array $alarmAction)
    {
        $this->data['AlarmAction'] = $alarmAction;
        foreach ($alarmAction as $i => $iValue) {
            $this->options['query']['AlarmAction.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withDimension(array $dimension)
    {
        $this->data['Dimension'] = $dimension;
        foreach ($dimension as $depth1 => $depth1Value) {
            if (isset($depth1Value['DimensionValue'])) {
                $this->options['query']['Dimension.' . ($depth1 + 1) . '.DimensionValue'] = $depth1Value['DimensionValue'];
            }
            if (isset($depth1Value['DimensionKey'])) {
                $this->options['query']['Dimension.' . ($depth1 + 1) . '.DimensionKey'] = $depth1Value['DimensionKey'];
            }
        }

        return $this;
    }
}
