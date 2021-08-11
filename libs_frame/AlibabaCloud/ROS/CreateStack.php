<?php

namespace AlibabaCloud\ROS;

/**
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getTemplateBody()
 * @method $this withTemplateBody($value)
 * @method string getDisableRollback()
 * @method $this withDisableRollback($value)
 * @method string getTimeoutInMinutes()
 * @method $this withTimeoutInMinutes($value)
 * @method string getOrderSource()
 * @method $this withOrderSource($value)
 * @method string getTemplateURL()
 * @method $this withTemplateURL($value)
 * @method string getActivityId()
 * @method $this withActivityId($value)
 * @method array getNotificationURLs()
 * @method string getStackPolicyURL()
 * @method $this withStackPolicyURL($value)
 * @method string getStackName()
 * @method $this withStackName($value)
 * @method array getParameters()
 * @method string getStackPolicyBody()
 * @method $this withStackPolicyBody($value)
 * @method string getChannelId()
 * @method $this withChannelId($value)
 */
class CreateStack extends Rpc
{
    /**
     * @return $this
     */
    public function withNotificationURLs(array $notificationURLs)
    {
        $this->data['NotificationURLs'] = $notificationURLs;
        foreach ($notificationURLs as $i => $iValue) {
            $this->options['query']['NotificationURLs.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withParameters(array $parameters)
    {
        $this->data['Parameters'] = $parameters;
        foreach ($parameters as $depth1 => $depth1Value) {
            $this->options['query']['Parameters.' . ($depth1 + 1) . '.ParameterValue'] = $depth1Value['ParameterValue'];
            $this->options['query']['Parameters.' . ($depth1 + 1) . '.ParameterKey'] = $depth1Value['ParameterKey'];
        }

        return $this;
    }
}
