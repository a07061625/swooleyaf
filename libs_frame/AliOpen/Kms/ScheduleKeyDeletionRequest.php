<?php

namespace AliOpen\Kms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ScheduleKeyDeletion
 *
 * @method string getPendingWindowInDays()
 * @method string getKeyId()
 */
class ScheduleKeyDeletionRequest extends RpcAcsRequest
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
        parent::__construct('Kms', '2016-01-20', 'ScheduleKeyDeletion', 'kms');
    }

    /**
     * @param string $pendingWindowInDays
     *
     * @return $this
     */
    public function setPendingWindowInDays($pendingWindowInDays)
    {
        $this->requestParameters['PendingWindowInDays'] = $pendingWindowInDays;
        $this->queryParameters['PendingWindowInDays'] = $pendingWindowInDays;

        return $this;
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
