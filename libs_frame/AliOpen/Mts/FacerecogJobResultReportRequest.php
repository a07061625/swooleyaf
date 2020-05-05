<?php
namespace AliOpen\Mts;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ReportFacerecogJobResult
 * @method string getJobId()
 * @method string getResourceOwnerId()
 * @method string getResourceOwnerAccount()
 * @method string getFacerecog()
 * @method string getOwnerAccount()
 * @method string getDetails()
 * @method string getOwnerId()
 */
class FacerecogJobResultReportRequest extends RpcAcsRequest
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
        parent::__construct('Mts', '2014-06-18', 'ReportFacerecogJobResult', 'mts');
    }

    /**
     * @param string $jobId
     * @return $this
     */
    public function setJobId($jobId)
    {
        $this->requestParameters['JobId'] = $jobId;
        $this->queryParameters['JobId'] = $jobId;

        return $this;
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
     * @param string $facerecog
     * @return $this
     */
    public function setFacerecog($facerecog)
    {
        $this->requestParameters['Facerecog'] = $facerecog;
        $this->queryParameters['Facerecog'] = $facerecog;

        return $this;
    }

    /**
     * @param string $ownerAccount
     * @return $this
     */
    public function setOwnerAccount($ownerAccount)
    {
        $this->requestParameters['OwnerAccount'] = $ownerAccount;
        $this->queryParameters['OwnerAccount'] = $ownerAccount;

        return $this;
    }

    /**
     * @param string $details
     * @return $this
     */
    public function setDetails($details)
    {
        $this->requestParameters['Details'] = $details;
        $this->queryParameters['Details'] = $details;

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
}
