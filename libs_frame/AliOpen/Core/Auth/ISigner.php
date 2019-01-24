<?php
namespace AliOpen\Core\Auth;

interface ISigner {
    public function getSignatureMethod();

    public function getSignatureVersion();

    /**
     * @param $source
     * @param $accessSecret
     * @return mixed
     */
    public function signString($source, $accessSecret);

    public function getSignatureType();
}
