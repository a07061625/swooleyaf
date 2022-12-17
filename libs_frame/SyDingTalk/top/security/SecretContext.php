<?php

    class SecretContext
    {
        public $secret;
        public $secretVersion;
        public $invalidTime;
        public $maxInvalidTime;
        public $appConfig;

        public $cacheKey = '';
        public $session = '';
        public $encryptPhoneNum = 0;
        public $encryptNickNum = 0;
        public $encryptReceiverNameNum = 0;
        public $encryptSimpleNum = 0;
        public $encryptSearchNum = 0;

        public $decryptPhoneNum = 0;
        public $decryptNickNum = 0;
        public $decryptReceiverNameNum = 0;
        public $decryptSimpleNum = 0;
        public $decryptSearchNum = 0;

        public $searchPhoneNum = 0;
        public $searchNickNum = 0;
        public $searchReceiverNameNum = 0;
        public $searchSimpleNum = 0;
        public $searchSearchNum = 0;

        public $lastUploadTime;

        public function __construct()
        {
            $this->lastUploadTime = time();
        }

        public function toLogString()
        {
            return $this->session . ',' . $this->encryptPhoneNum . ',' . $this->encryptNickNum . ','
                  . $this->encryptReceiverNameNum . ',' . $this->encryptSimpleNum . ',' . $this->encryptSearchNum . ','
                  . $this->decryptPhoneNum . ',' . $this->decryptNickNum . ',' . $this->decryptReceiverNameNum . ','
                  . $this->decryptSimpleNum . ',' . $this->decryptSearchNum . ',' . $this->searchPhoneNum . ','
                  . $this->searchNickNum . ',' . $this->searchReceiverNameNum . ',' . $this->searchSimpleNum . ','
                  . $this->searchSearchNum;
        }
    }

    class SecretData
    {
        public $originalValue;
        public $originalBase64Value;
        public $secretVersion;
        public $search;

        public function __construct()
        {
        }
    }
