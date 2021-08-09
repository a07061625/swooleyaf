<?php

namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ModifyPhoneTags
 *
 * @method string getInstanceId()
 * @method array getSkillGroupIdLists()
 * @method string getServiceTag()
 */
class ModifyPhoneTagsRequest extends RpcAcsRequest
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
            'ModifyPhoneTags',
            'CCC'
        );
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
    public function setSkillGroupIdLists(array $skillGroupIdList)
    {
        $this->requestParameters['SkillGroupIdLists'] = $skillGroupIdList;
        foreach ($skillGroupIdList as $i => $iValue) {
            $this->queryParameters['SkillGroupIdList.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $serviceTag
     *
     * @return $this
     */
    public function setServiceTag($serviceTag)
    {
        $this->requestParameters['ServiceTag'] = $serviceTag;
        $this->queryParameters['ServiceTag'] = $serviceTag;

        return $this;
    }
}
