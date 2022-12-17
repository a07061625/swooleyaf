<?php

class TopSecretGetRequest
{
    private $apiParas = [];

    public function getApiMethodName()
    {
        return 'taobao.top.secret.get';
    }

    public function getApiParas()
    {
        return $this->apiParas;
    }

    public function setRandomNum($random)
    {
        $this->apiParas['random_num'] = $random;
    }

    public function setCustomerUserId($customId)
    {
        $this->apiParas['customer_user_id'] = $customId;
    }

    public function setSecretVersion($version)
    {
        $this->apiParas['secret_version'] = $version;
    }

    public function check()
    {
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
