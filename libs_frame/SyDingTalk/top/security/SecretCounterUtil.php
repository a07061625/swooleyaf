<?php

    include './SecretContext.php';
    include './iCache.php';
    include '../../TopSdk.php';

    class SecretCounterUtil
    {
        private $topClient ;
        private $cacheClient = null;

        private $counterMap;

        public function __construct($client)
        {
            $this->topClient = $client;

            $counterMap = array();
        }

        /*
        * 如果不走缓存模式，析构即调用API回传统计信息
        */
        public function __destruct()
        {
            if ($this->cacheClient == null) {
            }
        }

        public function report($session)
        {
            $request = new TopSdkFeedbackUploadRequest;
        }

        public function setCacheClient($cache)
        {
            $this->cacheClient = $cache;
        }

        public function incrDecrypt($delt, $session, $type)
        {
            $item = getItem($session);
            if ($item == null) {
                $item = new SecretCounter();
                putItem($session, $item);
            }

            if ($type == "nick") {
                $item->$decryptNickNum += $delt;
            } elseif ($type == "receiver_name") {
                $item->$decryptReceiverNameNum += $delt ;
            } elseif ($type == "phone") {
                $item->$decryptPhoneNum += $delt ;
            } elseif ($type == "simple") {
                $item->$decryptSimpleNum += $delt ;
            }
        }

        public function incrEncrypt($delt, $session, $type)
        {
            $item = getItem($session);
            if ($item == null) {
                $item = new SecretCounter();
                putItem($session, $item);
            }

            if ($type == "nick") {
                $item->$encryptNickNum += $delt ;
            } elseif ($type == "receiver_name") {
                $item->$encryptReceiverNameNum += $delt ;
            } elseif ($type == "phone") {
                $item->$encryptPhoneNum += $delt ;
            } elseif ($type == "simple") {
                $item->$encryptSimpleNum += $delt ;
            }
        }

        public function getItem($session)
        {
            if ($this->cacheClient == null) {
                return $counterMap[$session];
            } else {
                return $this->cacheClient->getCache('s_'.$session);
            }
        }

        public function putItem($session, $item)
        {
            if ($this->cacheClient == null) {
                $counterMap[$session] = $item;
            } else {
                $this->cacheClient->setCache('s_'.$session, $item);
            }
        }
    }
