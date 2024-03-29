<?php

namespace AlibabaCloud\Client\Credentials\Providers;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Credentials\AccessKeyCredential;
use AlibabaCloud\Client\Credentials\Requests\GenerateSessionAccessKey;
use AlibabaCloud\Client\Credentials\StsCredential;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use AlibabaCloud\Client\Request\Request;
use AlibabaCloud\Client\Result\Result;
use AlibabaCloud\Client\SDK;
use AlibabaCloud\Client\Signature\ShaHmac256WithRsaSignature;

/**
 * Class RsaKeyPairProvider
 *
 * @package   AlibabaCloud\Client\Credentials\Providers
 */
class RsaKeyPairProvider extends Provider
{
    /**
     * Get credential.
     *
     * @param int $timeout
     * @param int $connectTimeout
     *
     * @return StsCredential
     *
     * @throws ClientException
     * @throws ServerException
     */
    public function get($timeout = Request::TIMEOUT, $connectTimeout = Request::CONNECT_TIMEOUT)
    {
        $credential = $this->getCredentialsInCache();

        if (null === $credential) {
            $result = $this->request($timeout, $connectTimeout);

            if (!isset($result['SessionAccessKey']['SessionAccessKeyId'], $result['SessionAccessKey']['SessionAccessKeySecret'])) {
                throw new ServerException($result, $this->error, SDK::INVALID_CREDENTIAL);
            }

            $credential = $result['SessionAccessKey'];
            $this->cache($credential);
        }

        return new StsCredential($credential['SessionAccessKeyId'], $credential['SessionAccessKeySecret']);
    }

    /**
     * Get credentials by request.
     *
     * @param $timeout
     * @param $connectTimeout
     *
     * @return Result
     *
     * @throws ClientException
     * @throws ServerException
     */
    private function request($timeout, $connectTimeout)
    {
        $clientName = __CLASS__ . uniqid('rsa', true);
        $credential = $this->client->getCredential();

        AlibabaCloud::client(
            new AccessKeyCredential($credential->getPublicKeyId(), $credential->getPrivateKey()),
            new ShaHmac256WithRsaSignature()
        )->name($clientName);

        return (new GenerateSessionAccessKey($credential->getPublicKeyId()))->client($clientName)->timeout($timeout)
            ->connectTimeout($connectTimeout)
            ->debug($this->client->isDebug())->request();
    }
}
