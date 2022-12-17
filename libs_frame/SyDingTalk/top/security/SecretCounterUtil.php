<?php

    include './SecretContext.php';
    include './iCache.php';
    include '../../TopSdk.php';

    class SecretCounterUtil
    {
        private $topClient;
        private $cacheClient;

        private $counterMap;

        public function __construct($client)
        {
            $this->topClient = $client;

            $counterMap = [];
        }

        // 如果不走缓存模式，析构即调用API回传统计信息
        public function __destruct()
        {
            if (null == $this->cacheClient) {
            }
        }

        public function report($session)
        {
            $request = new TopSdkFeedbackUploadRequest();
        }

        public function setCacheClient($cache)
        {
            $this->cacheClient = $cache;
        }

        public function incrDecrypt($delt, $session, $type)
        {
            $item = getItem($session);
            if (null == $item) {
                $item = new SecretCounter();
                putItem($session, $item);
            }

            if ('nick' == $type) {
                $item->{$decryptNickNum} += $delt;
            } elseif ('receiver_name' == $type) {
                $item->{$decryptReceiverNameNum} += $delt;
            } elseif ('phone' == $type) {
                $item->{$decryptPhoneNum} += $delt;
            } elseif ('simple' == $type) {
                $item->{$decryptSimpleNum} += $delt;
            }
        }

        public function incrEncrypt($delt, $session, $type)
        {
            $item = getItem($session);
            if (null == $item) {
                $item = new SecretCounter();
                putItem($session, $item);
            }

            if ('nick' == $type) {
                $item->{$encryptNickNum} += $delt;
            } elseif ('receiver_name' == $type) {
                $item->{$encryptReceiverNameNum} += $delt;
            } elseif ('phone' == $type) {
                $item->{$encryptPhoneNum} += $delt;
            } elseif ('simple' == $type) {
                $item->{$encryptSimpleNum} += $delt;
            }
        }

        public function getItem($session)
        {
            if (null == $this->cacheClient) {
                return $counterMap[$session];
            }

            return $this->cacheClient->getCache('s_' . $session);
        }

        public function putItem($session, $item)
        {
            if (null == $this->cacheClient) {
                $counterMap[$session] = $item;
            } else {
                $this->cacheClient->setCache('s_' . $session, $item);
            }
        }
    }
