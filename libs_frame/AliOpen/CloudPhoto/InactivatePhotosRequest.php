<?php

namespace AliOpen\CloudPhoto;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of InactivatePhotos
 *
 * @method string getLibraryId()
 * @method array getPhotoIds()
 * @method string getStoreName()
 * @method string getInactiveTime()
 */
class InactivatePhotosRequest extends RpcAcsRequest
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
        parent::__construct(
            'CloudPhoto',
            '2017-07-11',
            'InactivatePhotos',
            'cloudphoto'
        );
    }

    /**
     * @param string $libraryId
     *
     * @return $this
     */
    public function setLibraryId($libraryId)
    {
        $this->requestParameters['LibraryId'] = $libraryId;
        $this->queryParameters['LibraryId'] = $libraryId;

        return $this;
    }

    /**
     * @return $this
     */
    public function setPhotoIds(array $photoIds)
    {
        $this->requestParameters['PhotoIds'] = $photoIds;
        foreach ($photoIds as $i => $iValue) {
            $this->queryParameters['PhotoId.' . ($i + 1)] = $iValue;
        }

        return $this;
    }

    /**
     * @param string $storeName
     *
     * @return $this
     */
    public function setStoreName($storeName)
    {
        $this->requestParameters['StoreName'] = $storeName;
        $this->queryParameters['StoreName'] = $storeName;

        return $this;
    }

    /**
     * @param string $inactiveTime
     *
     * @return $this
     */
    public function setInactiveTime($inactiveTime)
    {
        $this->requestParameters['InactiveTime'] = $inactiveTime;
        $this->queryParameters['InactiveTime'] = $inactiveTime;

        return $this;
    }
}
