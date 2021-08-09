<?php

namespace AliOpen\Aegis;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SetDatasourceStatus
 *
 * @method string getProjectName()
 * @method string getSourceIp()
 * @method string getLogStoreName()
 * @method string getStatus()
 * @method string getRegionNo()
 */
class DatasourceStatusSetRequest extends RpcAcsRequest
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
        parent::__construct('aegis', '2016-11-11', 'SetDatasourceStatus', 'vipaegis');
    }

    /**
     * @param string $projectName
     *
     * @return $this
     */
    public function setProjectName($projectName)
    {
        $this->requestParameters['ProjectName'] = $projectName;
        $this->queryParameters['ProjectName'] = $projectName;

        return $this;
    }

    /**
     * @param string $sourceIp
     *
     * @return $this
     */
    public function setSourceIp($sourceIp)
    {
        $this->requestParameters['SourceIp'] = $sourceIp;
        $this->queryParameters['SourceIp'] = $sourceIp;

        return $this;
    }

    /**
     * @param string $logStoreName
     *
     * @return $this
     */
    public function setLogStoreName($logStoreName)
    {
        $this->requestParameters['LogStoreName'] = $logStoreName;
        $this->queryParameters['LogStoreName'] = $logStoreName;

        return $this;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->requestParameters['Status'] = $status;
        $this->queryParameters['Status'] = $status;

        return $this;
    }

    /**
     * @param string $regionNo
     *
     * @return $this
     */
    public function setRegionNo($regionNo)
    {
        $this->requestParameters['RegionNo'] = $regionNo;
        $this->queryParameters['RegionNo'] = $regionNo;

        return $this;
    }
}
