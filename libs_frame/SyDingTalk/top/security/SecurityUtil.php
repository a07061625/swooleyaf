<?php

    include './SecretContext.php';
    include './MagicCrypt.php';

    class SecurityUtil
    {
        private $BASE64_ARRAY = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
        private $SEPARATOR_CHAR_MAP;

        public function __construct()
        {
            if (!defined('PHONE_SEPARATOR_CHAR')) {
                define('PHONE_SEPARATOR_CHAR', '$');
            }
            if (!defined('NICK_SEPARATOR_CHAR')) {
                define('NICK_SEPARATOR_CHAR', '~');
            }
            if (!defined('NORMAL_SEPARATOR_CHAR')) {
                define('NORMAL_SEPARATOR_CHAR', chr(1));
            }

            $this->SEPARATOR_CHAR_MAP['nick'] = NICK_SEPARATOR_CHAR;
            $this->SEPARATOR_CHAR_MAP['simple'] = NICK_SEPARATOR_CHAR;
            $this->SEPARATOR_CHAR_MAP['receiver_name'] = NICK_SEPARATOR_CHAR;
            $this->SEPARATOR_CHAR_MAP['search'] = NICK_SEPARATOR_CHAR;
            $this->SEPARATOR_CHAR_MAP['normal'] = NORMAL_SEPARATOR_CHAR;
            $this->SEPARATOR_CHAR_MAP['phone'] = PHONE_SEPARATOR_CHAR;
        }

        // 判断是否是base64格式的数据
        public function isBase64Str($str)
        {
            $strLen = strlen($str);
            for ($i = 0; $i < $strLen; ++$i) {
                if (!$this->isBase64Char($str[$i])) {
                    return false;
                }
            }

            return true;
        }

        // 判断是否是base64格式的字符
        public function isBase64Char($char)
        {
            return false !== strpos($this->BASE64_ARRAY, $char);
        }

        // 使用sep字符进行trim
        public function trimBySep($str, $sep)
        {
            $start = 0;
            $end = strlen($str);
            for ($i = 0; $i < $end; ++$i) {
                if ($str[$i] == $sep) {
                    $start = $i + 1;
                } else {
                    break;
                }
            }
            for ($i = $end - 1; $i >= 0; --$i) {
                if ($str[$i] == $sep) {
                    $end = $i - 1;
                } else {
                    break;
                }
            }

            return substr($str, $start, $end);
        }

        public function checkEncryptData($dataArray)
        {
            if (2 == count($dataArray)) {
                return  $this->isBase64Str($dataArray[0]);
            }

            return  $this->isBase64Str($dataArray[0]) && $this->isBase64Str($dataArray[1]);
        }

        // 判断是否是加密数据
        public function isEncryptDataArray($array, $type)
        {
            foreach ($array as $value) {
                if (!$this->isEncryptData($value, $type)) {
                    return false;
                }
            }

            return true;
        }

        /**
         * 判断是否是已加密的数据，数据必须是同一个类型
         *
         * @param mixed $array
         * @param mixed $type
         */
        public function isPartEncryptData($array, $type)
        {
            $result = false;
            foreach ($array as $value) {
                if ($this->isEncryptData($value, $type)) {
                    $result = true;

                    break;
                }
            }

            return $result;
        }

        // 判断是否是加密数据
        public function isEncryptData($data, $type)
        {
            if (!is_string($data) || strlen($data) < 4) {
                return false;
            }

            $separator = $this->SEPARATOR_CHAR_MAP[$type];
            $strlen = strlen($data);
            if ($data[0] != $separator || $data[$strlen - 1] != $separator) {
                return false;
            }

            $dataArray = explode($separator, $this->trimBySep($data, $separator));
            $arrayLength = count($dataArray);

            if (PHONE_SEPARATOR_CHAR == $separator) {
                if (3 != $arrayLength) {
                    return false;
                }
                if ($data[$strlen - 2] == $separator) {
                    return $this->checkEncryptData($dataArray);
                }
                $version = $dataArray[$arrayLength - 1];
                if (is_numeric($version)) {
                    $base64Val = $dataArray[$arrayLength - 2];

                    return $this->isBase64Str($base64Val);
                }
            } else {
                if ($data[strlen($data) - 2] == $separator && 3 == $arrayLength) {
                    return $this->checkEncryptData($dataArray);
                }
                if (2 == $arrayLength) {
                    return $this->checkEncryptData($dataArray);
                }

                return false;
            }
        }

        public function search($data, $type, $secretContext)
        {
            $separator = $this->SEPARATOR_CHAR_MAP[$type];
            if ('phone' == $type) {
                if (4 != strlen($data)) {
                    throw new Exception('phoneNumber error');
                }

                return $separator . $this->hmacMD5EncryptToBase64($data, $secretContext->secret) . $separator;
            }
            $compressLen = $this->getArrayValue($secretContext->appConfig, 'encrypt_index_compress_len', 3);
            $slideSize = $this->getArrayValue($secretContext->appConfig, 'encrypt_slide_size', 4);

            $slideList = $this->getSlideWindows($data, $slideSize);
            $builder = '';
            foreach ($slideList as $slide) {
                $builder .= $this->hmacMD5EncryptToBase64($slide, $secretContext->secret, $compressLen);
            }

            return $builder;
        }

        // 加密逻辑
        public function encrypt($data, $type, $version, $secretContext)
        {
            if (!is_string($data)) {
                return false;
            }

            $separator = $this->SEPARATOR_CHAR_MAP[$type];
            $isIndexEncrypt = $this->isIndexEncrypt($type, $version, $secretContext);
            if ($isIndexEncrypt || 'search' == $type) {
                if ('phone' == $type) {
                    return $this->encryptPhoneIndex($data, $separator, $secretContext);
                }
                $compressLen = $this->getArrayValue($secretContext->appConfig, 'encrypt_index_compress_len', 3);
                $slideSize = $this->getArrayValue($secretContext->appConfig, 'encrypt_slide_size', 4);

                return $this->encryptNormalIndex($data, $compressLen, $slideSize, $separator, $secretContext);
            }
            if ('phone' == $type) {
                return $this->encryptPhone($data, $separator, $secretContext);
            }

            return $this->encryptNormal($data, $separator, $secretContext);
        }

        // 加密逻辑,手机号码格式
        public function encryptPhone($data, $separator, $secretContext)
        {
            $len = strlen($data);
            if ($len < 11) {
                return $data;
            }
            $prefixNumber = substr($data, 0, $len - 8);
            $last8Number = substr($data, $len - 8, $len);

            return $separator . $prefixNumber . $separator . Security::encrypt($last8Number, $secretContext->secret)
                  . $separator . $secretContext->secretVersion . $separator;
        }

        // 加密逻辑,非手机号码格式
        public function encryptNormal($data, $separator, $secretContext)
        {
            return $separator . Security::encrypt($data, $secretContext->secret)
                             . $separator . $secretContext->secretVersion . $separator;
        }

        // 解密逻辑
        public function decrypt($data, $type, $secretContext)
        {
            if (!$this->isEncryptData($data, $type)) {
                throw new Exception('数据[' . $data . ']不是类型为[' . $type . ']的加密数据');
            }
            $dataLen = strlen($data);
            $separator = $this->SEPARATOR_CHAR_MAP[$type];

            $secretData = null;
            if ($data[$dataLen - 2] == $separator) {
                $secretData = $this->getIndexSecretData($data, $separator);
            } else {
                $secretData = $this->getSecretData($data, $separator);
            }

            if (null == $secretData) {
                return $data;
            }

            $result = Security::decrypt($secretData->originalBase64Value, $secretContext->secret);

            if (PHONE_SEPARATOR_CHAR == $separator && !$secretData->search) {
                return $secretData->originalValue . $result;
            }

            return $result;
        }

        // 判断是否是公钥数据
        public function isPublicData($data, $type)
        {
            $secretData = $this->getSecretDataByType($data, $type);
            if (empty($secretData)) {
                return false;
            }
            if ((int)($secretData->secretVersion) < 0) {
                return true;
            }

            return false;
        }

        public function getSecretDataByType($data, $type)
        {
            $separator = $this->SEPARATOR_CHAR_MAP[$type];
            $dataLen = strlen($data);

            if ($data[$dataLen - 2] == $separator) {
                return $secretData = $this->getIndexSecretData($data, $separator);
            }

            return  $secretData = $this->getSecretData($data, $separator);
        }

        // 分解密文
        public function getSecretData($data, $separator)
        {
            $secretData = new SecretData();
            $dataArray = explode($separator, $this->trimBySep($data, $separator));
            $arrayLength = count($dataArray);

            if (PHONE_SEPARATOR_CHAR == $separator) {
                if (3 != $arrayLength) {
                    return;
                }
                $version = $dataArray[2];
                if (is_numeric($version)) {
                    $secretData->originalValue = $dataArray[0];
                    $secretData->originalBase64Value = $dataArray[1];
                    $secretData->secretVersion = $version;
                }
            } else {
                if (2 != $arrayLength) {
                    return;
                }
                $version = $dataArray[1];
                if (is_numeric($version)) {
                    $secretData->originalBase64Value = $dataArray[0];
                    $secretData->secretVersion = $version;
                }
            }

            return $secretData;
        }

        public function getIndexSecretData($data, $separator)
        {
            $secretData = new SecretData();
            $dataArray = explode($separator, $this->trimBySep($data, $separator));
            $arrayLength = count($dataArray);

            if (PHONE_SEPARATOR_CHAR == $separator) {
                if (3 != $arrayLength) {
                    return;
                }
                $version = $dataArray[2];
                if (is_numeric($version)) {
                    $secretData->originalValue = $dataArray[0];
                    $secretData->originalBase64Value = $dataArray[1];
                    $secretData->secretVersion = $version;
                }
            } else {
                if (3 != $arrayLength) {
                    return;
                }
                $version = $dataArray[2];
                if (is_numeric($version)) {
                    $secretData->originalBase64Value = $dataArray[0];
                    $secretData->originalValue = $dataArray[1];
                    $secretData->secretVersion = $version;
                }
            }

            $secretData->search = true;

            return $secretData;
        }

        /**
         * 判断密文是否支持检索
         *
         * @param key
         * @param version
         * @param mixed $key
         * @param mixed $version
         * @param mixed $secretContext
         *
         * @return
         */
        public function isIndexEncrypt($key, $version, $secretContext)
        {
            if (null != $version && $version < 0) {
                $key = 'previous_' . $key;
            } else {
                $key = 'current_' . $key;
            }

            return null != $secretContext->appConfig &&
                   array_key_exists($key, $secretContext->appConfig) &&
                   '2' == $secretContext->appConfig[$key];
        }

        public function isLetterOrDigit($ch)
        {
            $code = ord($ch);
            if (0 <= $code && $code <= 127) {
                return true;
            }

            return false;
        }

        public function utf8_strlen($string = null)
        {
            // 将字符串分解为单元
            preg_match_all('/./us', $string, $match);
            // 返回单元个数
            return count($match[0]);
        }

        public function utf8_substr($string, $start, $end)
        {
            // 将字符串分解为单元
            preg_match_all('/./us', $string, $match);
            // 返回单元个数
            $result = '';
            for ($i = $start; $i < $end; ++$i) {
                $result .= $match[0][$i];
            }

            return $result;
        }

        public function utf8_str_at($string, $index)
        {
            // 将字符串分解为单元
            preg_match_all('/./us', $string, $match);
            // 返回单元个数
            return $match[0][$index];
        }

        public function compress($input, $toLength)
        {
            if ($toLength < 0) {
                return;
            }
            $output = [];
            for ($i = 0; $i < $toLength; ++$i) {
                $output[$i] = chr(0);
            }
            $input = $this->getBytes($input);
            $inputLength = count($input);
            for ($i = 0; $i < $inputLength; ++$i) {
                $index_output = $i % $toLength;
                $output[$index_output] = $output[$index_output] ^ $input[$i];
            }

            return $output;
        }

        /**
         * @see #hmacMD5Encrypt
         *
         * @param encryptText
         *            被签名的字符串
         * @param encryptKey
         *            密钥
         * @param compressLen压缩长度
         * @param mixed $encryptText
         * @param mixed $encryptKey
         * @param mixed $compressLen
         *
         * @return
         *
         * @throws Exception
         */
        public function hmacMD5EncryptToBase64($encryptText, $encryptKey, $compressLen = 0)
        {
            $encryptResult = Security::hmac_md5($encryptText, $encryptKey);
            if (0 != $compressLen) {
                $encryptResult = $this->compress($encryptResult, $compressLen);
            }

            return base64_encode($this->toStr($encryptResult));
        }

        /**
         * 生成滑动窗口
         *
         * @param input
         * @param slideSize
         * @param mixed $input
         * @param mixed $slideSize
         *
         * @return
         */
        public function getSlideWindows($input, $slideSize = 4)
        {
            $endIndex = 0;
            $startIndex = 0;
            $currentWindowSize = 0;
            $currentWindow = null;
            $dataLength = $this->utf8_strlen($input);
            $windows = [];
            while ($endIndex < $dataLength || $currentWindowSize > $slideSize) {
                $startsWithLetterOrDigit = false;
                if (!empty($currentWindow)) {
                    $startsWithLetterOrDigit = $this->isLetterOrDigit($this->utf8_str_at($currentWindow, 0));
                }
                if ($endIndex == $dataLength && false == $startsWithLetterOrDigit) {
                    break;
                }
                if ($currentWindowSize == $slideSize &&
                   false == $startsWithLetterOrDigit &&
                   $this->isLetterOrDigit($this->utf8_str_at($input, $endIndex))) {
                    ++$endIndex;
                    $currentWindow = $this->utf8_substr($input, $startIndex, $endIndex);
                    $currentWindowSize = 5;
                } else {
                    if (0 != $endIndex) {
                        if ($startsWithLetterOrDigit) {
                            --$currentWindowSize;
                        } else {
                            $currentWindowSize -= 2;
                        }
                        ++$startIndex;
                    }

                    while ($currentWindowSize < $slideSize && $endIndex < $dataLength) {
                        $currentChar = $this->utf8_str_at($input, $endIndex);
                        if ($this->isLetterOrDigit($currentChar)) {
                            ++$currentWindowSize;
                        } else {
                            $currentWindowSize += 2;
                        }
                        ++$endIndex;
                    }
                    $currentWindow = $this->utf8_substr($input, $startIndex, $endIndex);
                }
                array_push($windows, $currentWindow);
            }

            return $windows;
        }

        public function encryptPhoneIndex($data, $separator, $secretContext)
        {
            $dataLength = strlen($data);
            if ($dataLength < 11) {
                return $data;
            }
            $last4Number = substr($data, $dataLength - 4, $dataLength);

            return $separator . $this->hmacMD5EncryptToBase64($last4Number, $secretContext->secret) . $separator
                   . Security::encrypt($data, $secretContext->secret) . $separator . $secretContext->secretVersion
                   . $separator . $separator;
        }

        public function encryptNormalIndex($data, $compressLen, $slideSize, $separator, $secretContext)
        {
            $slideList = $this->getSlideWindows($data, $slideSize);
            $builder = '';
            foreach ($slideList as $slide) {
                $builder .= $this->hmacMD5EncryptToBase64($slide, $secretContext->secret, $compressLen);
            }

            return $separator . Security::encrypt($data, $secretContext->secret) . $separator . $builder . $separator
                   . $secretContext->secretVersion . $separator . $separator;
        }

        public function getArrayValue($array, $key, $default)
        {
            if (array_key_exists($key, $array)) {
                return $array[$key];
            }

            return $default;
        }

        public function getBytes($string)
        {
            $bytes = [];
            for ($i = 0; $i < strlen($string); ++$i) {
                $bytes[] = ord($string[$i]);
            }

            return $bytes;
        }

        public function toStr($bytes)
        {
            if (!is_array($bytes)) {
                return $bytes;
            }
            $str = '';
            foreach ($bytes as $ch) {
                $str .= chr($ch);
            }

            return $str;
        }
    }
