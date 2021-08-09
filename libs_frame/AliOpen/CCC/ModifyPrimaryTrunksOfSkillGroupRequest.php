<?php

namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyPrimaryTrunksOfSkillGroup
 *
 * @method array getPrimaryProviderNames()
 * @method string getInstanceId()
 * @method string getSkillGroupId()
 */
class ModifyPrimaryTrunksOfSkillGroupRequest extends RpcAcsRequest
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
            'ModifyPrimaryTrunksOfSkillGroup',
            'CCC'
        );
    }

    /**
     * @return $this
     */
    public function setPrimaryProviderNames(array $primaryProviderName)
    {
        $this->requestParameters['PrimaryProviderNames'] = $primaryProviderName;
        foreach ($primaryProviderName as $i => $iValue) {
            $this->queryParameters['PrimaryProviderName.' . ($i + 1)] = $iValue;
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
}
