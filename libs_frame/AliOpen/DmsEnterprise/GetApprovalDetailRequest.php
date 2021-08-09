<?php

namespace AliOpen\DmsEnterprise;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetApprovalDetail
 *
 * @method string getTid()
 * @method string getWorkflowInstanceId()
 */
class GetApprovalDetailRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('dms-enterprise', '2018-11-01', 'GetApprovalDetail');
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
