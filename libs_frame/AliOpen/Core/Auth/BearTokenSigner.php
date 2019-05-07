<?php
namespace AliOpen\Core\Auth;

class BearTokenSigner implements ISigner
{
    /**
     * @param $source
     * @param $accessSecret
     * @return null
     */
    public function signString($source, $accessSecret)
    {
    }

    /**
     * @return null
     */
    public function getSignatureMethod()
    {
    }

    /**
     * @return string
     */
    public function getSignatureVersion()
    {
        return '1.0';
    }

    /**
     * @return string
     */
    public function getSignatureType()
    {
        return 'BEARERTOKEN';
    }
}
