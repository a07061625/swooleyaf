<?php

namespace AliOpen\ImageSearch;

use AliOpen\Core\RoaAcsRequest;

/**
 * Request of DeleteItem
 *
 * @method string getinstanceName()
 */
class DeleteItemRequest extends RoaAcsRequest
{
    /**
     * @var string
     */
    protected $uriPattern = '/item/delete';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('ImageSearch', '2018-01-20', 'DeleteItem', 'imagesearch');
    }

    /**
     * @param string $instanceName
     *
     * @return $this
     */
    public function setinstanceName($instanceName)
    {
        $this->requestParameters['instanceName'] = $instanceName;
        $this->queryParameters['instanceName'] = $instanceName;

        return $this;
    }
}
