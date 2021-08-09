<?php

namespace AliOpen\Foas;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of GetProject
 *
 * @method string getprojectName()
 */
class GetProjectRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';
    /**
     * @var string
     */
    protected $uriPattern = '/api/v2/projects/[projectName]';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('foas', '2018-11-11', 'GetProject', 'foas');
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
}
