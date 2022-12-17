<?php
    class Security
    {
        private static $iv = '0102030405060708';

        public static function encrypt($input, $key)
        {
            $key = base64_decode($key);
            $localIV = self::$iv;
            $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, $localIV);
            mcrypt_generic_init($module, $key, $localIV);
            $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
            $input = self::pkcs5_pad($input, $size);
            $data = mcrypt_generic($module, $input);

            mcrypt_generic_deinit($module);
            mcrypt_module_close($module);

            return base64_encode($data);
        }

        public static function hmac_md5($input, $key)
        {
            $key = base64_decode($key);

            return hash_hmac('md5', $input, $key, true);
        }

        public static function decrypt($sStr, $key)
        {
            $key = base64_decode($key);
            $localIV = self::$iv;
            $module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, $localIV);
            mcrypt_generic_init($module, $key, $localIV);
            $encryptedData = base64_decode($sStr);
            $encryptedData = mdecrypt_generic($module, $encryptedData);

            $dec_s = strlen($encryptedData);
            $padding = ord($encryptedData[$dec_s - 1]);
            $decrypted = substr($encryptedData, 0, -$padding);

            mcrypt_generic_deinit($module);
            mcrypt_module_close($module);
            if (!$decrypted) {
                throw new Exception('Decrypt Error,Please Check SecretKey');
            }

            return $decrypted;
        }

        private static function pkcs5_pad($text, $blocksize)
        {
            $pad = $blocksize - (strlen($text) % $blocksize);

            return $text . str_repeat(chr($pad), $pad);
        }
    }
