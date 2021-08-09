<?php

namespace AliOpen\Foas;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of GetInstanceHistoryAutoScalePlanContent
 *
 * @method string getprojectName()
 * @method string getinstanceId()
 * @method string getplanName()
 * @method string getjobName()
 */
class GetInstanceHistoryAutoScalePlanContentRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';
    /**
     * @var string
     */
    protected $uriPattern = '/api/v2/projects/[projectName]/jobs/[jobName]/instance/[instanceId]/autoscale/plancontent';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('foas', '2018-11-11', 'GetInstanceHistoryAutoScalePlanContent', 'foas');
    }

    /**
     * @param string $projectName
     *
     * @return $this
     */
    public function setprojectName($projectName)
    {
        $this->requestParameters['projectName'] = $projectName;
        $this->pathParameters['projectName'] = $projectName;

        return $this;
    }

    /**
     * @param string $instanceId
     *
     * @return $this
     */
    public function setinstanceId($instanceId)
    {
        $this->requestParameters['instanceId'] = $instanceId;
        $this->pathParameters['instanceId'] = $instanceId;

        return $this;
    }

    /**
     * @param string $planName
     *
     * @return $this
     */
    public function setplanName($planName)
    {
        $this->requestParameters['planName'] = $planName;
        $this->queryParameters['planName'] = $planName;

        return $this;
    }

    /**
     * @param string $jobName
     *
     * @return $this
     */
    public function setjobName($jobName)
    {
        $this->requestParameters['jobName'] = $jobName;
        $this->pathParameters['jobName'] = $jobName;

        return $this;
    }
}
