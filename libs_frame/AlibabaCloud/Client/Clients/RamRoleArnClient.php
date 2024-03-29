<?php

namespace AlibabaCloud\Client\Clients;

use AlibabaCloud\Client\Credentials\RamRoleArnCredential;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Signature\ShaHmac1Signature;

/**
 * Use the AssumeRole of the RAM account to complete  the authentication.
 *
 * @package   AlibabaCloud\Client\Clients
 */
class RamRoleArnClient extends Client
{
    /**
     * @param string       $accessKeyId
     * @param string       $accessKeySecret
     * @param string       $roleArn
     * @param string       $roleSessionName
     * @param array|string $policy
     *
     * @throws ClientException
     */
    public function __construct($accessKeyId, $accessKeySecret, $roleArn, $roleSessionName, $policy = '')
    {
        parent::__construct(
            new RamRoleArnCredential($accessKeyId, $accessKeySecret, $roleArn, $roleSessionName, $policy),
            new ShaHmac1Signature()
        );
    }
}
