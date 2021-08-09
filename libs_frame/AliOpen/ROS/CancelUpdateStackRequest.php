<?php

namespace AliOpen\ROS;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of CancelUpdateStack
 *
 * @method string getStackId()
 * @method string getStackName()
 */
class CancelUpdateStackRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/stacks/[StackName]/[StackId]/cancel';
    /**
     * @var string
     */
    protected $method = 'PUT';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('ROS', '2015-09-01', 'CancelUpdateStack');
    }

    /**
     * @param string $stackId
     *
     * @return $this
     */
    public function setStackId($stackId)
    {
        $this->requestParameters['StackId'] = $stackId;
        $this->pathParameters['StackId'] = $stackId;

        return $this;
    }

    /**
     * @param string $stackName
     *
     * @return $this
     */
    public function setStackName($stackName)
    {
        $this->requestParameters['StackName'] = $stackName;
        $this->pathParameters['StackName'] = $stackName;

        return $this;
    }
}
