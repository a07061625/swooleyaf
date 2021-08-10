<?php

namespace AlibabaCloud\Ecs;

/**
 * @method array getEventId()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getEventCycleStatus()
 * @method $this withEventCycleStatus($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getImpactLevel()
 * @method $this withImpactLevel($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method array getInstanceEventCycleStatus()
 * @method array getTag()
 * @method string getEventPublishTimeEnd()
 * @method array getResourceId()
 * @method array getInstanceEventType()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getNotBeforeStart()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceType()
 * @method $this withResourceType($value)
 * @method string getEventPublishTimeStart()
 * @method string getInstanceId()
 * @method $this withInstanceId($value)
 * @method string getNotBeforeEnd()
 * @method string getEventType()
 * @method $this withEventType($value)
 */
class DescribeInstanceHistoryEvents extends Rpc
{
    /**
     * @return $this
     */
    public function withEventId(array $eventId)
    {
        $this->data['EventId'] = $eventId;
        foreach ($eventId as $i => $iValue) {
            $this->options['query']['EventId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withInstanceEventCycleStatus(array $instanceEventCycleStatus)
    {
        $this->data['InstanceEventCycleStatus'] = $instanceEventCycleStatus;
        foreach ($instanceEventCycleStatus as $i => $iValue) {
            $this->options['query']['InstanceEventCycleStatus.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withTag(array $tag)
    {
        $this->data['Tag'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            if (isset($depth1Value['Key'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
            }
            if (isset($depth1Value['Value'])) {
                $this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            }
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEventPublishTimeEnd($value)
    {
        $this->data['EventPublishTimeEnd'] = $value;
        $this->options['query']['EventPublishTime.End'] = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function withResourceId(array $resourceId)
    {
        $this->data['ResourceId'] = $resourceId;
        foreach ($resourceId as $i => $iValue) {
            $this->options['query']['ResourceId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withInstanceEventType(array $instanceEventType)
    {
        $this->data['InstanceEventType'] = $instanceEventType;
        foreach ($instanceEventType as $i => $iValue) {
            $this->options['query']['InstanceEventType.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNotBeforeStart($value)
    {
        $this->data['NotBeforeStart'] = $value;
        $this->options['query']['NotBefore.Start'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withEventPublishTimeStart($value)
    {
        $this->data['EventPublishTimeStart'] = $value;
        $this->options['query']['EventPublishTime.Start'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNotBeforeEnd($value)
    {
        $this->data['NotBeforeEnd'] = $value;
        $this->options['query']['NotBefore.End'] = $value;

        return $this;
    }
}
