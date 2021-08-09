<?php
namespace AliOpen\CS;

use AliOpen\Core\RoaAcsRequest;

/**
 * 
 *
 * Request of CreateClusterByResourcesGroup
 *
 * @method string getResourceGroupId()
 */
class CreateClusterByResourcesGroupRequest extends RoaAcsRequest
{

    /**
     * @var string
     */
    protected $uriPattern = '/resource_groups/[ResourceGroupId]/clusters';

    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'CS',
            '2015-12-15',
            'CreateClusterByResourcesGroup'
        );
    }

    /**
     * @param string $resourceGroupId
     *
     * @return $this
     */
    public function setResourceGroupId($resourceGroupId)
    {
        $this->requestParameters['ResourceGroupId'] = $resourceGroupId;
        $this->pathParameters['ResourceGroupId'] = $resourceGroupId;

        return $this;
    }
}
