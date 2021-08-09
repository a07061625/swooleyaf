<?php

namespace AliOpen\DmsEnterprise;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ApproveOrder
 *
 * @method string getApprovalType()
 * @method string getTid()
 * @method string getWorkflowInstanceId()
 */
class ApproveOrderRequest extends RpcAcsRequest
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
        parent::__construct('dms-enterprise', '2018-11-01', 'ApproveOrder');
    }

    /**
     * @param string $approvalType
     *
     * @return $this
     */
    public function setApprovalType($approvalType)
    {
        $this->requestParameters['ApprovalType'] = $approvalType;
        $this->queryParameters['ApprovalType'] = $approvalType;

        return $this;
    }

    /**
     * @param string $tid
     *
     * @return $this
     */
    public function setTid($tid)
    {
        $this->requestParameters['Tid'] = $tid;
        $this->queryParameters['Tid'] = $tid;

        return $this;
    }

    /**
     * @param string $workflowInstanceId
     *
     * @return $this
     */
    public function setWorkflowInstanceId($workflowInstanceId)
    {
        $this->requestParameters['WorkflowInstanceId'] = $workflowInstanceId;
        $this->queryParameters['WorkflowInstanceId'] = $workflowInstanceId;

        return $this;
    }
}
