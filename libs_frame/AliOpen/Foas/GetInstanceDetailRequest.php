<?php

namespace AliOpen\Foas;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of GetInstanceDetail
 *
 * @method string getprojectName()
 * @method string getinstanceId()
 * @method string getjobName()
 */
class GetInstanceDetailRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';
    /**
     * @var string
     */
    protected $uriPattern = '/api/v2/projects/[projectName]/jobs/[jobName]/instances/[instanceId]/details';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('foas', '2018-11-11', 'GetInstanceDetail', 'foas');
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
