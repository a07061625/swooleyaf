<?php

namespace AliOpen\Kms;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of ListResourceTags
 *
 * @method string getKeyId()
 */
class ListResourceTagsRequest extends RpcAcsRequest
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
        parent::__construct('Kms', '2016-01-20', 'ListResourceTags', 'kms');
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
