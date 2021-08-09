<?php

namespace AliOpen\DmsEnterprise;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of RevokeUserPermission
 *
 * @method string getPermTypes()
 * @method string getUserAccessId()
 * @method string getDsType()
 * @method string getUserId()
 * @method string getTid()
 * @method string getDbId()
 * @method string getTableId()
 * @method string getLogic()
 * @method string getTableName()
 */
class RevokeUserPermissionRequest extends RpcAcsRequest
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
        parent::__construct('dms-enterprise', '2018-11-01', 'RevokeUserPermission');
    }

    /**
     * @param string $permTypes
     *
     * @return $this
     */
    public function setPermTypes($permTypes)
    {
        $this->requestParameters['PermTypes'] = $permTypes;
        $this->queryParameters['PermTypes'] = $permTypes;

        return $this;
    }

    /**
     * @param string $userAccessId
     *
     * @return $this
     */
    public function setUserAccessId($userAccessId)
    {
        $this->requestParameters['UserAccessId'] = $userAccessId;
        $this->queryParameters['UserAccessId'] = $userAccessId;

        return $this;
    }

    /**
     * @param string $dsType
     *
     * @return $this
     */
    public function setDsType($dsType)
    {
        $this->requestParameters['DsType'] = $dsType;
        $this->queryParameters['DsType'] = $dsType;

        return $this;
    }

    /**
     * @param string $userId
     *
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->requestParameters['UserId'] = $userId;
        $this->queryParameters['UserId'] = $userId;

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
     * @param string $tableId
     *
     * @return $this
     */
    public function setTableId($tableId)
    {
        $this->requestParameters['TableId'] = $tableId;
        $this->queryParameters['TableId'] = $tableId;

        return $this;
    }

    /**
     * @param string $logic
     *
     * @return $this
     */
    public function setLogic($logic)
    {
        $this->requestParameters['Logic'] = $logic;
        $this->queryParameters['Logic'] = $logic;

        return $this;
    }

    /**
     * @param string $tableName
     *
     * @return $this
     */
    public function setTableName($tableName)
    {
        $this->requestParameters['TableName'] = $tableName;
        $this->queryParameters['TableName'] = $tableName;

        return $this;
    }
}
