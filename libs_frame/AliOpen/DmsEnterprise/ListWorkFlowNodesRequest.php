<?php
namespace AliOpen\DmsEnterprise;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListWorkFlowNodes
 * @method string getSearchName()
 * @method string getTid()
 */
class ListWorkFlowNodesRequest extends RpcAcsRequest
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
        parent::__construct('dms-enterprise', '2018-11-01', 'ListWorkFlowNodes');
    }

    /**
     * @param string $searchName
     * @return $this
     */
    public function setSearchName($searchName)
    {
        $this->requestParameters['SearchName'] = $searchName;
        $this->queryParameters['SearchName'] = $searchName;

        return $this;
    }

    /**
     * @param string $tid
     * @return $this
     */
    public function setTid($tid)
    {
        $this->requestParameters['Tid'] = $tid;
        $this->queryParameters['Tid'] = $tid;

        return $this;
    }
}
