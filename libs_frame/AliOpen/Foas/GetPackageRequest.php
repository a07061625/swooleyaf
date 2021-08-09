<?php

namespace AliOpen\Foas;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of GetPackage
 *
 * @method string getprojectName()
 * @method string getpackageName()
 */
class GetPackageRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';
    /**
     * @var string
     */
    protected $uriPattern = '/api/v2/projects/[projectName]/packages/[packageName]';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('foas', '2018-11-11', 'GetPackage', 'foas');
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
     * @param string $packageName
     *
     * @return $this
     */
    public function setpackageName($packageName)
    {
        $this->requestParameters['packageName'] = $packageName;
        $this->pathParameters['packageName'] = $packageName;

        return $this;
    }
}
