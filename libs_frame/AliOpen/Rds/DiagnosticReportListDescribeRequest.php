<?php
namespace AliOpen\Rds;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of DescribeDiagnosticReportList
 * @method string getDBInstanceId()
 */
class DiagnosticReportListDescribeRequest extends RpcAcsRequest
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
        parent::__construct('Rds', '2014-08-15', 'DescribeDiagnosticReportList', 'rds');
    }

    /**
     * @param string $dBInstanceId
     * @return $this
     */
    public function setDBInstanceId($dBInstanceId)
    {
        $this->requestParameters['DBInstanceId'] = $dBInstanceId;
        $this->queryParameters['DBInstanceId'] = $dBInstanceId;

        return $this;
    }
}
