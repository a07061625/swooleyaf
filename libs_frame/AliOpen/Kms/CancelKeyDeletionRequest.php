<?php

namespace AliOpen\Kms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CancelKeyDeletion
 *
 * @method string getKeyId()
 */
class CancelKeyDeletionRequest extends RpcAcsRequest
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
        parent::__construct('Kms', '2016-01-20', 'CancelKeyDeletion', 'kms');
    }

    /**
     * @param string $keyId
     *
     * @return $this
     */
    public function setKeyId($keyId)
    {
        $this->requestParameters['KeyId'] = $keyId;
        $this->queryParameters['KeyId'] = $keyId;

        return $this;
    }
}