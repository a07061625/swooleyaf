<?php

namespace AliOpen\DmsEnterprise;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of GetLogicDatabase
 *
 * @method string getDbId()
 * @method string getTid()
 */
class GetLogicDatabaseRequest extends RpcAcsRequest
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('dms-enterprise', '2018-11-01', 'GetLogicDatabase');
    }

    /**
     * @param string $dbId
     *
     * @return $this
     */
    public function setDbId($dbId)
    {
        $this->requestParameters['DbId'] = $dbId;
        $this->queryParameters['DbId'] = $dbId;

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
