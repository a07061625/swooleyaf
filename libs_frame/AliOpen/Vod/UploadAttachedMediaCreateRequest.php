<?php
namespace AliOpen\Vod;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateUploadAttachedMedia
 * @method string getResourceOwnerId()
 * @method string getIcon()
 * @method string getDescription()
 * @method string getFileSize()
 * @method string getTitle()
 * @method string getBusinessType()
 * @method string getStorageLocation()
 * @method string getUserData()
 * @method string getCateId()
 * @method string getResourceOwnerAccount()
 * @method string getCateIds()
 * @method string getOwnerId()
 * @method string getTags()
 * @method string getMediaExt()
 * @method string getFileName()
 * @method string getAppId()
 */
class UploadAttachedMediaCreateRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('vod', '2017-03-21', 'CreateUploadAttachedMedia', 'vod');
    }

    /**
     * @param string $resourceOwnerId
     * @return $this
     */
    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->requestParameters['ResourceOwnerId'] = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;

        return $this;
    }

    /**
     * @param string $icon
     * @return $this
     */
    public function setIcon($icon)
    {
        $this->requestParameters['Icon'] = $icon;
        $this->queryParameters['Icon'] = $icon;

        return $this;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->requestParameters['Description'] = $description;
        $this->queryParameters['Description'] = $description;

        return $this;
    }

    /**
     * @param string $fileSize
     * @return $this
     */
    public function setFileSize($fileSize)
    {
        $this->requestParameters['FileSize'] = $fileSize;
        $this->queryParameters['FileSize'] = $fileSize;

        return $this;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->requestParameters['Title'] = $title;
        $this->queryParameters['Title'] = $title;

        return $this;
    }

    /**
     * @param string $businessType
     * @return $this
     */
    public function setBusinessType($businessType)
    {
        $this->requestParameters['BusinessType'] = $businessType;
        $this->queryParameters['BusinessType'] = $businessType;

        return $this;
    }

    /**
     * @param string $storageLocation
     * @return $this
     */
    public function setStorageLocation($storageLocation)
    {
        $this->requestParameters['StorageLocation'] = $storageLocation;
        $this->queryParameters['StorageLocation'] = $storageLocation;

        return $this;
    }

    /**
     * @param string $userData
     * @return $this
     */
    public function setUserData($userData)
    {
        $this->requestParameters['UserData'] = $userData;
        $this->queryParameters['UserData'] = $userData;

        return $this;
    }

    /**
     * @param string $cateId
     * @return $this
     */
    public function setCateId($cateId)
    {
        $this->requestParameters['CateId'] = $cateId;
        $this->queryParameters['CateId'] = $cateId;

        return $this;
    }

    /**
     * @param string $resourceOwnerAccount
     * @return $this
     */
    public function setResourceOwnerAccount($resourceOwnerAccount)
    {
        $this->requestParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;
        $this->queryParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;

        return $this;
    }

    /**
     * @param string $cateIds
     * @return $this
     */
    public function setCateIds($cateIds)
    {
        $this->requestParameters['CateIds'] = $cateIds;
        $this->queryParameters['CateIds'] = $cateIds;

        return $this;
    }

    /**
     * @param string $ownerId
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }

    /**
     * @param string $tags
     * @return $this
     */
    public function setTags($tags)
    {
        $this->requestParameters['Tags'] = $tags;
        $this->queryParameters['Tags'] = $tags;

        return $this;
    }

    /**
     * @param string $mediaExt
     * @return $this
     */
    public function setMediaExt($mediaExt)
    {
        $this->requestParameters['MediaExt'] = $mediaExt;
        $this->queryParameters['MediaExt'] = $mediaExt;

        return $this;
    }

    /**
     * @param string $fileName
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->requestParameters['FileName'] = $fileName;
        $this->queryParameters['FileName'] = $fileName;

        return $this;
    }

    /**
     * @param string $appId
     * @return $this
     */
    public function setAppId($appId)
    {
        $this->requestParameters['AppId'] = $appId;
        $this->queryParameters['AppId'] = $appId;

        return $this;
    }
}
