<?php

namespace AlibabaCloud\Client\Credentials;

use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Filter\CredentialFilter;
use AlibabaCloud\Client\SDK;
use Exception;

/**
 * Use the RSA key pair to complete the authentication (supported only on Japanese site)
 *
 * @package   AlibabaCloud\Client\Credentials
 */
class RsaKeyPairCredential implements CredentialsInterface
{
    /**
     * @var string
     */
    private $publicKeyId;
    /**
     * @var string
     */
    private $privateKey;

    /**
     * RsaKeyPairCredential constructor.
     *
     * @param string $publicKeyId
     * @param string $privateKeyFile
     *
     * @throws ClientException
     */
    public function __construct($publicKeyId, $privateKeyFile)
    {
        CredentialFilter::publicKeyId($publicKeyId);
        CredentialFilter::privateKeyFile($privateKeyFile);

        $this->publicKeyId = $publicKeyId;

        try {
            $this->privateKey = file_get_contents($privateKeyFile);
        } catch (Exception $exception) {
            throw new ClientException($exception->getMessage(), SDK::INVALID_CREDENTIAL);
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "publicKeyId#{$this->publicKeyId}";
    }

    /**
     * @return mixed
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * @return string
     */
    public function getPublicKeyId()
    {
        return $this->publicKeyId;
    }
}
