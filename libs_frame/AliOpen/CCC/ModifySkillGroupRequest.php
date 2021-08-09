<?php

namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifySkillGroup
 *
 * @method string getAllowPrivateOutboundNumber()
 * @method string getDescription()
 * @method string getRoutingStrategy()
 * @method array getUserIds()
 * @method array getSkillLevels()
 * @method string getInstanceId()
 * @method array getOutboundPhoneNumberIds()
 * @method string getSkillGroupId()
 * @method string getName()
 */
class ModifySkillGroupRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'CCC',
            '2017-07-05',
            'ModifySkillGroup',
            'CCC'
        );
    }

    /**
     * @param string $allowPrivateOutboundNumber
     *
     * @return $this
     */
    public function setAllowPrivateOutboundNumber($allowPrivateOutboundNumber)
    {
        $this->requestParameters['AllowPrivateOutboundNumber'] = $allowPrivateOutboundNumber;
        $this->queryParameters['AllowPrivateOutboundNumber'] = $allowPrivateOutboundNumber;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->requestParameters['Description'] = $description;
        $this->queryParameters['Description'] = $description;

        return $this;
    }

    /**
     * @param string $routingStrategy
     *
     * @return $this
     */
    public function setRoutingStrategy($routingStrategy)
    {
        $this->requestParameters['RoutingStrategy'] = $routingStrategy;
        $this->queryParameters['RoutingStrategy'] = $routingStrategy;

        return $this;
    }

    /**
     * @return $this
     */
    public function setUserIds(array $userId)
    {
        $this->requestParameters['UserIds'] = $userId;
        foreach ($userId as $i => $iValue) {
            $this->queryParameters['UserId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function setSkillLevels(array $skillLevel)
    {
        $this->requestParameters['SkillLevels'] = $skillLevel;
        foreach ($skillLevel as $i => $iValue) {
            $this->queryParameters['SkillLevel.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $instanceId
     *
     * @return $this
     */
    public function setInstanceId($instanceId)
    {
        $this->requestParameters['InstanceId'] = $instanceId;
        $this->queryParameters['InstanceId'] = $instanceId;

        return $this;
    }

    /**
     * @return $this
     */
    public function setOutboundPhoneNumberIds(array $outboundPhoneNumberId)
    {
        $this->requestParameters['OutboundPhoneNumberIds'] = $outboundPhoneNumberId;
        foreach ($outboundPhoneNumberId as $i => $iValue) {
            $this->queryParameters['OutboundPhoneNumberId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $skillGroupId
     *
     * @return $this
     */
    public function setSkillGroupId($skillGroupId)
    {
        $this->requestParameters['SkillGroupId'] = $skillGroupId;
        $this->queryParameters['SkillGroupId'] = $skillGroupId;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->requestParameters['Name'] = $name;
        $this->queryParameters['Name'] = $name;

        return $this;
    }
}
