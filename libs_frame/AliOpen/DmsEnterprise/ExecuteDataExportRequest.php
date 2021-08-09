<?php

namespace AliOpen\DmsEnterprise;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ExecuteDataExport
 *
 * @method string getActionDetail()
 * @method string getOrderId()
 * @method string getActionName()
 * @method string getTid()
 */
class ExecuteDataExportRequest extends RpcAcsRequest
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
        parent::__construct('dms-enterprise', '2018-11-01', 'ExecuteDataExport');
    }

    /**
     * @param string $actionDetail
     *
     * @return $this
     */
    public function setActionDetail($actionDetail)
    {
        $this->requestParameters['ActionDetail'] = $actionDetail;
        $this->queryParameters['ActionDetail'] = $actionDetail;

        return $this;
    }

    /**
     * @param string $orderId
     *
     * @return $this
     */
    public function setOrderId($orderId)
    {
        $this->requestParameters['OrderId'] = $orderId;
        $this->queryParameters['OrderId'] = $orderId;

        return $this;
    }

    /**
     * @param string $actionName
     *
     * @return $this
     */
    public function setActionName($actionName)
    {
        $this->requestParameters['ActionName'] = $actionName;
        $this->queryParameters['ActionName'] = $actionName;

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
}
