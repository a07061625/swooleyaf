<?php

namespace AliOpen\LinkFace;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of SearchFace
 * @method string getImage()
 * @method string getGroupId()
 */
class SearchFaceRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $requestScheme = 'https';
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('LinkFace', '2018-07-20', 'SearchFace');
    }

    /**
     * @param string $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->requestParameters['Image'] = $image;
        $this->queryParameters['Image'] = $image;

        return $this;
    }

    /**
     * @param string $groupId
     * @return $this
     */
    public function setGroupId($groupId)
    {
        $this->requestParameters['GroupId'] = $groupId;
        $this->queryParameters['GroupId'] = $groupId;

        return $this;
    }
}
