<?php

namespace AliOpen\Gpdb;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeResourceUsage
 *
 * @method string getDBInstanceId()
 */
class DescribeResourceUsageRequest extends RpcAcsRequest
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
        parent::__construct('gpdb', '2016-05-03', 'DescribeResourceUsage', 'gpdb');
    }

    /**
     * @param string $dBInstanceId
     *
     * @return $this
     */
    public function setDBInstanceId($dBInstanceId)
    {
        $this->requestParameters['DBInstanceId'] = $dBInstanceId;
        $this->queryParameters['DBInstanceId'] = $dBInstanceId;

        return $this;
    }
}
