<?php

namespace AliOpen\Foas;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of BatchGetInstanceRunSummary
 *
 * @method string getprojectName()
 * @method string getjobNames()
 * @method string getjobType()
 */
class BatchGetInstanceRunSummaryRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';
    /**
     * @var string
     */
    protected $uriPattern = '/api/v2/projects/[projectName]/runsummary';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('foas', '2018-11-11', 'BatchGetInstanceRunSummary', 'foas');
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
     * @param string $jobNames
     *
     * @return $this
     */
    public function setjobNames($jobNames)
    {
        $this->requestParameters['jobNames'] = $jobNames;
        $this->queryParameters['jobNames'] = $jobNames;

        return $this;
    }

    /**
     * @param string $jobType
     *
     * @return $this
     */
    public function setjobType($jobType)
    {
        $this->requestParameters['jobType'] = $jobType;
        $this->queryParameters['jobType'] = $jobType;

        return $this;
    }
}
