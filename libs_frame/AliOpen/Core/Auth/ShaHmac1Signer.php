<?php
namespace AliOpen\Core\Auth;

class ShaHmac1Signer implements ISigner {
    /**
     * @param $source
     * @param $accessSecret
     * @return string
     */
    public function signString($source, $accessSecret){
        return base64_encode(hash_hmac('sha1', $source, $accessSecret, true));
    }

    /**
     * @return string
     */
    public function getSignatureMethod(){
        return 'HMAC-SHA1';
    }

    /**
     * @return string
     */
    public function getSignatureVersion(){
        return '1.0';
    }

    /**
     * @return null
     */
    public function getSignatureType(){
        return null;
    }
}
