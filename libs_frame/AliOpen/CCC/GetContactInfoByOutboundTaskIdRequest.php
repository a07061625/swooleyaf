<?php
namespace AliOpen\CCC;

use AliOpen\Core\RpcAcsRequest;

/**
 *
 *
 * Request of GetContactInfoByOutboundTaskId
 *
 * @method string getInstanceId()
 * @method string getOutboundTaskId()
 * @method string getSkillGroupId()
 */
class GetContactInfoByOutboundTaskIdRequest extends RpcAcsRequest
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
            'GetContactInfoByOutboundTaskId'
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
     * @param string $outboundTaskId
     *
     * @return $this
     */
    public function setOutboundTaskId($outboundTaskId)
    {
        $this->requestParameters['OutboundTaskId'] = $outboundTaskId;
        $this->queryParameters['OutboundTaskId'] = $outboundTaskId;

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
