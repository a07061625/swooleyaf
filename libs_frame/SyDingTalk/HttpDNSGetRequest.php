<?php

namespace SyDingTalk;

class HttpDNSGetRequest
{
    private $apiParas = [];

    public function getApiMethodName()
    {
        return 'taobao.httpdns.get';
    }

    public function getApiParas()
    {
        return $this->apiParas;
    }

    public function check()
    {
        //null
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
