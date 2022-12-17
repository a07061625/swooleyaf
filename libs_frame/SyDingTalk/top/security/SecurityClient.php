<?php

    include './SecurityUtil.php';
    include './SecretGetRequest.php';
    include './TopSdkFeedbackUploadRequest.php';
    include './iCache.php';
    include '../../TopSdk.php';

    class SecurityClient
    {
        private $topClient;
        private $randomNum;
        private $securityUtil;
        private $cacheClient;

        public function __construct($client, $random)
        {
            define('APP_SECRET_TYPE', '2');
            define('APP_USER_SECRET_TYPE', '3');

            $this->topClient = $client;
            $this->randomNum = $random;
            $this->securityUtil = new SecurityUtil();
        }

        /**
         * 设置缓存处理器
         *
         * @param mixed $cache
         */
        public function setCacheClient($cache)
        {
            $this->cacheClient = $cache;
        }

        /**
         * 密文检索,在秘钥升级场景下兼容查询
         *
         * @see #search(String, String, String, Long)
         *
         * @return
         *
         * @param mixed      $data
         * @param mixed      $type
         * @param null|mixed $session
         */
        public function searchPrevious($data, $type, $session = null)
        {
            return $this->searchInner($data, $type, $session, -1);
        }

        /**
         * 密文检索（每个用户单独分配秘钥）
         *
         * @see #search(String, String, String, Long)
         *
         * @return
         *
         * @param mixed      $data
         * @param mixed      $type
         * @param null|mixed $session
         */
        public function search($data, $type, $session = null)
        {
            return $this->searchInner($data, $type, $session, null);
        }

        /**
         * 密文检索。 手机号码格式：$base64(H-MAC(phone后4位))$ simple格式：base64(H-MAC(滑窗))
         *
         * @param data
         *            明文数据
         * @param type
         *            加密字段类型(例如：simple\phone)
         * @param session
         *            用户身份,用户级加密必填
         * @param version
         *            秘钥历史版本
         * @param mixed $data
         * @param mixed $type
         * @param mixed $session
         * @param mixed $version
         *
         * @return
         */
        public function searchInner($data, $type, $session, $version)
        {
            if (empty($data) || empty($type)) {
                return $data;
            }

            $secretContext = null;

            $secretContext = $this->callSecretApiWithCache($session, $version);
            $this->incrCounter(3, $type, $secretContext, true);

            if (empty($secretContext) || empty($secretContext->secret)) {
                return $data;
            }

            return $this->securityUtil->search($data, $type, $secretContext);
        }

        /**
         * 单条数据解密,使用appkey级别公钥
         * 非加密数据直接返回原文
         *
         * @param mixed $data
         * @param mixed $type
         */
        public function decryptPublic($data, $type)
        {
            return $this->decrypt($data, $type, null);
        }

        /**
         * 单条数据解密
         * 非加密数据直接返回原文
         *
         * @param mixed $data
         * @param mixed $type
         * @param mixed $session
         */
        public function decrypt($data, $type, $session)
        {
            if (empty($data) || empty($type)) {
                return $data;
            }
            $secretData = $this->securityUtil->getSecretDataByType($data, $type);
            if (empty($secretData)) {
                return $data;
            }

            if ($this->securityUtil->isPublicData($data, $type)) {
                $secretContext = $this->callSecretApiWithCache(null, $secretData->secretVersion);
            } else {
                $secretContext = $this->callSecretApiWithCache($session, $secretData->secretVersion);
            }
            $this->incrCounter(2, $type, $secretContext, true);

            return $this->securityUtil->decrypt($data, $type, $secretContext);
        }

        /**
         * 多条数据解密，使用appkey级别公钥
         * 非加密数据直接返回原文
         *
         * @param mixed $array
         * @param mixed $type
         */
        public function decryptBatchPublic($array, $type)
        {
            if (empty($array) || empty($type)) {
                return;
            }

            $result = [];
            foreach ($array as $value) {
                $secretData = $this->securityUtil->getSecretDataByType($value, $type);
                $secretContext = $this->callSecretApiWithCache(null, $secretData->secretVersion);

                if (empty($secretData)) {
                    $result[$value] = $value;
                } else {
                    $result[$value] = $this->securityUtil->decrypt($value, $type, $secretContext);
                    $this->incrCounter(2, $type, $secretContext, true);
                }

                $this->flushCounter($secretContext);
            }

            return $result;
        }

        /**
         * 多条数据解密，必须是同一个type和用户,返回结果是 KV结果
         * 非加密数据直接返回原文
         *
         * @param mixed $array
         * @param mixed $type
         * @param mixed $session
         */
        public function decryptBatch($array, $type, $session)
        {
            if (empty($array) || empty($type)) {
                return;
            }

            $result = [];
            foreach ($array as $value) {
                $secretData = $this->securityUtil->getSecretDataByType($value, $type);
                if (empty($secretData)) {
                    $result[$value] = $value;
                } elseif ($this->securityUtil->isPublicData($value, $type)) {
                    $appContext = $this->callSecretApiWithCache(null, $secretData->secretVersion);
                    $result[$value] = $this->securityUtil->decrypt($value, $type, $appContext);
                    $this->incrCounter(2, $type, $appContext, false);
                    $this->flushCounter($appContext);
                } else {
                    $secretContext = $this->callSecretApiWithCache($session, $secretData->secretVersion);
                    $result[$value] = $this->securityUtil->decrypt($value, $type, $secretContext);
                    $this->incrCounter(2, $type, $secretContext, false);
                    $this->flushCounter($secretContext);
                }
            }

            return $result;
        }

        /**
         * 使用上一版本秘钥解密，app级别公钥
         *
         * @param mixed $data
         * @param mixed $type
         */
        public function decryptPreviousPublic($data, $type)
        {
            $secretContext = $this->callSecretApiWithCache(null, -1);

            return $this->securityUtil->decrypt($data, $type, $secretContext);
        }

        /**
         * 使用上一版本秘钥解密，一般只用于更新秘钥
         *
         * @param mixed $data
         * @param mixed $type
         * @param mixed $session
         */
        public function decryptPrevious($data, $type, $session)
        {
            if ($this->securityUtil->isPublicData($data, $type)) {
                $secretContext = $this->callSecretApiWithCache(null, -1);
            } else {
                $secretContext = $this->callSecretApiWithCache($session, -1);
            }

            return $this->securityUtil->decrypt($data, $type, $secretContext);
        }

        /**
         * 加密单条数据,使用app级别公钥
         *
         * @param mixed      $data
         * @param mixed      $type
         * @param null|mixed $version
         */
        public function encryptPublic($data, $type, $version = null)
        {
            return $this->encrypt($data, $type, null, $version);
        }

        /**
         * 加密单条数据
         *
         * @param mixed      $data
         * @param mixed      $type
         * @param null|mixed $session
         * @param null|mixed $version
         */
        public function encrypt($data, $type, $session = null, $version = null)
        {
            if (empty($data) || empty($type)) {
                return;
            }
            $secretContext = $this->callSecretApiWithCache($session, null);
            $this->incrCounter(1, $type, $secretContext, true);

            return $this->securityUtil->encrypt($data, $type, $version, $secretContext);
        }

        /**
         * 加密多条数据，使用app级别公钥
         *
         * @param mixed      $array
         * @param mixed      $type
         * @param null|mixed $version
         */
        public function encryptBatchPublic($array, $type, $version = null)
        {
            if (empty($array) || empty($type)) {
                return;
            }
            $secretContext = $this->callSecretApiWithCache(null, null);
            $result = [];
            foreach ($array as $value) {
                $result[$value] = $this->securityUtil->encrypt($value, $type, $version, $secretContext);
                $this->incrCounter(1, $type, $secretContext, false);
            }
            $this->flushCounter($secretContext);

            return $result;
        }

        /**
         * 加密多条数据，必须是同一个type和用户,返回结果是 KV结果
         *
         * @param mixed      $array
         * @param mixed      $type
         * @param mixed      $session
         * @param null|mixed $version
         */
        public function encryptBatch($array, $type, $session, $version = null)
        {
            if (empty($array) || empty($type)) {
                return;
            }
            $secretContext = $this->callSecretApiWithCache($session, null);
            $result = [];
            foreach ($array as $value) {
                $result[$value] = $this->securityUtil->encrypt($value, $type, $version, $secretContext);
                $this->incrCounter(1, $type, $secretContext, false);
            }
            $this->flushCounter($secretContext);

            return $result;
        }

        /**
         * 使用上一版本秘钥加密，使用app级别公钥
         *
         * @param mixed $data
         * @param mixed $type
         */
        public function encryptPreviousPublic($data, $type)
        {
            $secretContext = $this->callSecretApiWithCache(null, -1);
            $this->incrCounter(1, $type, $secretContext, true);

            return $this->securityUtil->encrypt($data, $type, $secretContext->version, $secretContext);
        }

        /**
         * 使用上一版本秘钥加密，一般只用于更新秘钥
         *
         * @param mixed $data
         * @param mixed $type
         * @param mixed $session
         */
        public function encryptPrevious($data, $type, $session)
        {
            $secretContext = $this->callSecretApiWithCache($session, -1);
            $this->incrCounter(1, $type, $secretContext, true);

            return $this->securityUtil->encrypt($data, $type, $secretContext);
        }

        /**
         * 根据session生成秘钥
         *
         * @param mixed $session
         */
        public function initSecret($session)
        {
            return $this->callSecretApiWithCache($session, null);
        }

        public function buildCacheKey($session, $secretVersion)
        {
            if (empty($session)) {
                return $this->topClient->getAppkey();
            }
            if (empty($secretVersion)) {
                return $session;
            }

            return $session . '_' . $secretVersion;
        }

        public function generateCustomerSession($userId)
        {
            return '_' . $userId;
        }

        /**
         * 判断是否是已加密的数据
         *
         * @param mixed $data
         * @param mixed $type
         */
        public function isEncryptData($data, $type)
        {
            if (empty($data) || empty($type)) {
                return false;
            }

            return $this->securityUtil->isEncryptData($data, $type);
        }

        /**
         * 判断是否是已加密的数据，数据必须是同一个类型
         *
         * @param mixed $array
         * @param mixed $type
         */
        public function isEncryptDataArray($array, $type)
        {
            if (empty($array) || empty($type)) {
                return false;
            }

            return $this->securityUtil->isEncryptDataArray($array, $type);
        }

        /**
         * 判断数组中的数据是否存在密文，存在任何一个返回true,否则false
         *
         * @param mixed $array
         * @param mixed $type
         */
        public function isPartEncryptData($array, $type)
        {
            if (empty($array) || empty($type)) {
                return false;
            }

            return $this->securityUtil->isPartEncryptData($array, $type);
        }

        /**
         * 获取秘钥，使用缓存
         *
         * @param mixed $session
         * @param mixed $secretVersion
         */
        public function callSecretApiWithCache($session, $secretVersion)
        {
            if ($this->cacheClient) {
                $time = time();
                $cacheKey = $this->buildCacheKey($session, $secretVersion);
                $secretContext = $this->cacheClient->getCache($cacheKey);

                if ($secretContext) {
                    if ($this->canUpload($secretContext)) {
                        if ($this->report($secretContext)) {
                            $this->clearReport($secretContext);
                        }
                    }
                }

                if ($secretContext && $secretContext->invalidTime > $time) {
                    return $secretContext;
                }
            }

            $secretContext = $this->callSecretApi($session, $secretVersion);

            if ($this->cacheClient) {
                $secretContext->cacheKey = $cacheKey;
                $this->cacheClient->setCache($cacheKey, $secretContext);
            }

            return $secretContext;
        }

        public function incrCounter($op, $type, $secretContext, $flush)
        {
            if (1 == $op) {
                switch ($type) {
                    case 'nick':
                    $secretContext->encryptNickNum++;

                        break;
                    case 'simple':
                        $secretContext->encryptSimpleNum++;

                        break;
                    case 'receiver_name':
                        $secretContext->encryptReceiverNameNum++;

                        break;
                    case 'phone':
                        $secretContext->encryptPhoneNum++;

                        break;
                    default:
                        break;
                }
            } elseif (2 == $op) {
                switch ($type) {
                    case 'nick':
                    $secretContext->decryptNickNum++;

                        break;
                    case 'simple':
                        $secretContext->decryptSimpleNum++;

                        break;
                    case 'receiver_name':
                        $secretContext->decryptReceiverNameNum++;

                        break;
                    case 'phone':
                        $secretContext->decryptPhoneNum++;

                        break;
                    default:
                        break;
                }
            } else {
                switch ($type) {
                    case 'nick':
                    $secretContext->searchNickNum++;

                        break;
                    case 'simple':
                        $secretContext->searchSimpleNum++;

                        break;
                    case 'receiver_name':
                        $secretContext->searchReceiverNameNum++;

                        break;
                    case 'phone':
                        $secretContext->searchPhoneNum++;

                        break;
                    default:
                        break;
                }
            }

            if ($flush && $this->cacheClient) {
                $this->cacheClient->setCache($secretContext->cacheKey, $secretContext);
            }
        }

        public function flushCounter($secretContext)
        {
            if ($this->cacheClient) {
                $this->cacheClient->setCache($secretContext->cacheKey, $secretContext);
            }
        }

        public function clearReport($secretContext)
        {
            $secretContext->encryptPhoneNum = 0;
            $secretContext->encryptNickNum = 0;
            $secretContext->encryptReceiverNameNum = 0;
            $secretContext->encryptSimpleNum = 0;
            $secretContext->encryptSearchNum = 0;
            $secretContext->decryptPhoneNum = 0;
            $secretContext->decryptNickNum = 0;
            $secretContext->decryptReceiverNameNum = 0;
            $secretContext->decryptSimpleNum = 0;
            $secretContext->decryptSearchNum = 0;
            $secretContext->searchPhoneNum = 0;
            $secretContext->searchNickNum = 0;
            $secretContext->searchReceiverNameNum = 0;
            $secretContext->searchSimpleNum = 0;
            $secretContext->searchSearchNum = 0;
            $secretContext->lastUploadTime = time();
        }

        public function canUpload($secretContext)
        {
            $current = time();
            if ($current - $secretContext->lastUploadTime > 300) {
                return true;
            }

            return false;
        }

        // 上报信息
        public function report($secretContext)
        {
            $request = new TopSdkFeedbackUploadRequest();
            $request->setContent($secretContext->toLogString());

            if (empty($secretContext->session)) {
                $request->setType(APP_SECRET_TYPE);
            } else {
                $request->setType(APP_USER_SECRET_TYPE);
            }

            $response = $this->topClient->execute($request, $secretContext->session);
            if (0 == $response->code) {
                return true;
            }

            return false;
        }

        /**
         * 获取秘钥，不使用缓存
         *
         * @param mixed $session
         * @param mixed $secretVersion
         */
        public function callSecretApi($session, $secretVersion)
        {
            $request = new TopSecretGetRequest();
            $request->setRandomNum($this->randomNum);
            if ($secretVersion) {
                if ((int)$secretVersion < 0 || null == $session) {
                    $session = null;
                    $secretVersion = -1 * (int)($secretVersion < 0);
                }
                $request->setSecretVersion($secretVersion);
            }

            $topSession = $session;
            if (null != $session && '_' == $session[0]) {
                $request->setCustomerUserId(substr($session, 1));
                $topSession = null;
            }

            $response = $this->topClient->execute($request, $topSession);
            if (0 != $response->code) {
                throw new Exception($response->msg);
            }

            $time = time();
            $secretContext = new SecretContext();
            $secretContext->maxInvalidTime = $time + (int)($response->max_interval);
            $secretContext->invalidTime = $time + (int)($response->interval);
            $secretContext->secret = (string)($response->secret);
            $secretContext->session = $session;
            if (!empty($response->app_config)) {
                $tmpJson = json_decode($response->app_config);
                $appConfig = [];
                foreach ($tmpJson as $key => $value) {
                    $appConfig[$key] = $value;
                }
                $secretContext->appConfig = $appConfig;
            }

            if (empty($session)) {
                $secretContext->secretVersion = -1 * (int)($response->secret_version);
            } else {
                $secretContext->secretVersion = (int)($response->secret_version);
            }

            return $secretContext;
        }
    }
