<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/2 0002
 * Time: 11:18
 */

namespace SyTool;

use DesignPatterns\Factories\CacheSimpleFactory;
use Swoole\Client;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyConstant\ProjectBase;
use SyConstant\SyInner;
use SyException\Common\CheckException;
use SyQr\PHPZxing\PHPZxingDecoder;
use SyQr\PHPZxing\ZxingImage;
use SyServer\BaseServer;
use SyTrait\SimpleTrait;
use Yaf\Registry;

class Tool
{
    use SimpleTrait;
    const CURL_RSP_HEAD_TYPE_EMPTY = 0; //curl响应头类型-空
    const CURL_RSP_HEAD_TYPE_HTTP = 1; //curl响应头类型-HTTP
    private static $totalCurlRspHeadType = [
        self::CURL_RSP_HEAD_TYPE_EMPTY => 1,
        self::CURL_RSP_HEAD_TYPE_HTTP => 1,
    ];
    private static $totalChars = [
        '2', '3', '4', '5', '6', '7', '8', '9',
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
        'i', 'j', 'k', 'm', 'n', 'p', 'q', 'r',
        's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H',
        'I', 'J', 'K', 'L', 'M', 'N', 'P', 'Q',
        'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y',
        'Z',
    ];
    private static $lowerChars = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
        'i', 'j', 'k', 'm', 'n', 'p', 'q', 'r',
        's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
    ];
    private static $numLowerChars = [
        '2', '3', '4', '5', '6', '7', '8', '9',
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
        'i', 'j', 'k', 'm', 'n', 'p', 'q', 'r',
        's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
    ];

    /**
     * 生成唯一ID
     *
     * @param string $createType 生成类型,可选值:redis(默认) swoole
     */
    public static function createUniqueId(string $createType = 'redis'): string
    {
        if ('redis' == $createType) {
            $num = CacheSimpleFactory::getRedisInstance()->incr(Project::DATA_KEY_CACHE_UNIQUE_ID);

            return date('YmdHis') . substr($num, -8);
        }
        $arr = BaseServer::getUniqueNum();

        return $arr['token'] . date('YmdHis') . substr((string)$arr['unique_num'], -8);
    }

    /**
     * 获取数组值
     *
     * @param array      $array       数组
     * @param int|string $key         键值
     * @param object     $default     默认值
     * @param bool       $isRecursion 是否递归查找,false:不递归 true:递归
     *
     * @return mixed
     */
    public static function getArrayVal(array $array, $key, $default = null, bool $isRecursion = false)
    {
        if (!$isRecursion) {
            return $array[$key] ?? $default;
        }

        $keyArr = explode('.', (string)$key);
        $tempData = $array;
        unset($array);
        foreach ($keyArr as $eKey) {
            if (\is_array($tempData) && isset($tempData[$eKey])) {
                $tempData = $tempData[$eKey];
            } else {
                return $default;
            }
        }

        return $tempData;
    }

    /**
     * 获取配置信息
     *
     * @param string $tag     配置标识
     * @param string $field   字段名称
     * @param mixed  $default 默认值
     *
     * @return mixed
     */
    public static function getConfig(string $tag, string $field = '', $default = null)
    {
        $configs = \Yaconf::get(SY_CONFIG_PREFIX . $tag);
        if (null === $configs) {
            return $default;
        }
        if (\is_array($configs) && (\strlen($field) > 0)) {
            return self::getArrayVal($configs, $field, $default);
        }

        return $configs;
    }

    /**
     * array转xml
     *
     * @param int $transferType 转换类型
     *
     * @throws \SyException\Common\CheckException
     */
    public static function arrayToXml(array $dataArr, int $transferType = 1): string
    {
        if (0 == \count($dataArr)) {
            throw new CheckException('数组为空', ErrorCode::COMMON_PARAM_ERROR);
        }

        $xml = '';
        if (1 == $transferType) {
            $xml .= '<xml>';
            foreach ($dataArr as $key => $value) {
                if (is_numeric($value)) {
                    $xml .= '<' . $key . '>' . $value . '</' . $key . '>';
                } else {
                    $xml .= '<' . $key . '><![CDATA[' . $value . ']]></' . $key . '>';
                }
            }
            $xml .= '</xml>';
        } elseif (2 == $transferType) {
            foreach ($dataArr as $key => $value) {
                $xml .= '<' . $key . '>' . $value . '</' . $key . '>';
            }
        } else {
            foreach ($dataArr as $key => $value) {
                $xml .= '<' . $key . '><![CDATA[' . $value . ']]></' . $key . '>';
            }
        }

        return $xml;
    }

    /**
     * xml转为array
     *
     * @return array
     *
     * @throws \SyException\Common\CheckException
     */
    public static function xmlToArray(string $xml)
    {
        if (0 == \strlen($xml)) {
            throw new CheckException('xml数据异常', ErrorCode::COMMON_PARAM_ERROR);
        }

        $element = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $jsonStr = self::jsonEncode($element);

        return self::jsonDecode($jsonStr);
    }

    /**
     * RSA签名
     *
     * @param string $data          待签名数据
     * @param string $priKeyContent 私钥文件内容
     *
     * @return string 签名结果
     */
    public static function rsaSign(string $data, string $priKeyContent): string
    {
        $priKey = openssl_get_privatekey($priKeyContent);
        openssl_sign($data, $sign, $priKey);
        openssl_free_key($priKey);

        return base64_encode($sign);
    }

    /**
     * RSA验签
     *
     * @param string $data          待签名数据
     * @param string $pubKeyContent 公钥文件内容
     * @param string $sign          要校对的的签名结果
     *
     * @return bool 验证结果
     */
    public static function rsaVerify(string $data, string $pubKeyContent, string $sign): bool
    {
        $pubKey = openssl_get_publickey($pubKeyContent);
        $result = (bool)openssl_verify($data, base64_decode($sign, true), $pubKey);
        openssl_free_key($pubKey);

        return $result;
    }

    /**
     * RSA加密
     *
     * @param string $data       待加密数据
     * @param string $keyContent 密钥文件内容,根据模式不同设置公钥或私钥
     * @param int    $mode       模式 0:公钥加密 1:私钥加密
     */
    public static function rsaEncrypt(string $data, string $keyContent, int $mode = 0): string
    {
        $dataArr = str_split($data, 117);
        $encryptArr = [];
        if (0 == $mode) { //公钥加密
            $key = openssl_get_publickey($keyContent);
            foreach ($dataArr as $eData) {
                $eEncrypt = '';
                openssl_public_encrypt($eData, $eEncrypt, $key);
                $encryptArr[] = $eEncrypt;
            }
        } else { //私钥加密
            $key = openssl_get_privatekey($keyContent);
            foreach ($dataArr as $eData) {
                $eEncrypt = '';
                openssl_private_encrypt($eData, $eEncrypt, $key);
                $encryptArr[] = $eEncrypt;
            }
        }
        openssl_free_key($key);

        return base64_encode(implode('', $encryptArr));
    }

    /**
     * RSA解密
     *
     * @param string $data       待解密数据
     * @param string $keyContent 密钥文件内容,根据模式不同设置公钥或私钥
     * @param int    $mode       模式 0:私钥解密 1:公钥解密
     */
    public static function rsaDecrypt(string $data, string $keyContent, int $mode = 0): string
    {
        $decryptStr = '';
        $encryptData = base64_decode($data, true);
        $length = \strlen($encryptData) / 128;
        if (0 == $mode) { //私钥解密
            $key = openssl_get_privatekey($keyContent);
            for ($i = 0; $i < $length; ++$i) {
                $eDecrypt = '';
                $eEncrypt = substr($encryptData, $i * 128, 128);
                openssl_private_decrypt($eEncrypt, $eDecrypt, $key);
                $decryptStr .= $eDecrypt;
            }
        } else { //公钥解密
            $key = openssl_get_publickey($keyContent);
            for ($i = 0; $i < $length; ++$i) {
                $eDecrypt = '';
                $eEncrypt = substr($encryptData, $i * 128, 128);
                openssl_public_decrypt($eEncrypt, $eDecrypt, $key);
                $decryptStr .= $eDecrypt;
            }
        }
        openssl_free_key($key);

        return $decryptStr;
    }

    /**
     * md5签名字符串
     *
     * @param string $needStr 需要签名的字符串
     * @param string $key     私钥
     *
     * @return string 签名结果
     */
    public static function md5Sign(string $needStr, string $key): string
    {
        return md5($needStr . $key);
    }

    /**
     * md5验证签名
     *
     * @param string $needStr 需要签名的字符串
     * @param string $sign    签名结果
     * @param string $key     私钥
     *
     * @return bool 签名结果
     */
    public static function md5Verify(string $needStr, string $sign, string $key): bool
    {
        $nowSign = md5($needStr . $key);

        return $nowSign === $sign;
    }

    /**
     * 加密
     *
     * @param string $content 待加密内容
     * @param string $key     密钥
     *
     * @throws \Exception
     */
    public static function encrypt(string $content, string $key): string
    {
        $iv = self::createNonceStr(16);
        $data = [
            'iv' => $iv,
            'value' => openssl_encrypt($content, 'AES-256-CBC', $key, 0, $iv),
        ];

        return base64_encode(self::jsonEncode($data));
    }

    /**
     * 解密
     *
     * @param string $content 密文
     * @param string $key     密钥
     *
     * @return bool|string
     */
    public static function decrypt(string $content, string $key)
    {
        $data = self::jsonDecode(base64_decode($content));
        if (\is_array($data) && (!empty($data))) {
            return openssl_decrypt($data['value'], 'AES-256-CBC', $key, 0, $data['iv']);
        }

        return false;
    }

    /**
     * 获取命令行输入
     *
     * @param int|string $key        键名
     * @param bool       $isIndexKey 键名是否为索引 true:是索引 false:不是索引
     * @param mixed      $default    默认值
     *
     * @return mixed
     */
    public static function getClientOption($key, bool $isIndexKey = false, $default = null)
    {
        global $argv;

        $option = $default;
        if ($isIndexKey) {
            if (isset($argv[$key])) {
                $option = $argv[$key];
            }
        } else {
            foreach ($argv as $eKey => $eVal) {
                if (($key == $eVal) && isset($argv[$eKey + 1])) {
                    $option = $argv[$eKey + 1];

                    break;
                }
            }
        }

        return $option;
    }

    /**
     * 压缩数据
     *
     * @param mixed $data 需要压缩的数据
     *
     * @return bool|string
     */
    public static function pack($data)
    {
        return msgpack_pack($data);
    }

    /**
     * 解压数据
     *
     * @param string $data      压缩数据字符串
     * @param string $className 解压类型名称
     *
     * @return mixed
     */
    public static function unpack(string $data, string $className = 'array')
    {
        if ('array' == $className) {
            return msgpack_unpack($data);
        }

        return msgpack_unpack($data, $className);
    }

    /**
     * 序列化数据
     *
     * @param mixed $data
     *
     * @return string
     */
    public static function serialize($data)
    {
        return msgpack_serialize($data);
    }

    /**
     * 反序列化数据
     *
     * @return mixed
     */
    public static function unserialize(string $str, string $className = 'array')
    {
        if ('array' == $className) {
            return msgpack_unserialize($str);
        }

        return msgpack_unserialize($str, $className);
    }

    /**
     * 把数组转移成json字符串
     *
     * @param array|object $arr
     * @param int|string   $options
     *
     * @return bool|string
     */
    public static function jsonEncode($arr, $options = JSON_OBJECT_AS_ARRAY)
    {
        if (\is_array($arr) || \is_object($arr)) {
            return json_encode($arr, $options);
        }

        return false;
    }

    /**
     * 解析json
     *
     * @param int|string $assoc
     *
     * @return mixed
     */
    public static function jsonDecode(string $json, $assoc = JSON_OBJECT_AS_ARRAY)
    {
        return json_decode($json, $assoc);
    }

    /**
     * 生成随机字符串
     *
     * @param int    $length   需要获取的随机字符串长度
     * @param string $dataType 数据类型<pre>
     *                         total: 数字,大小写字母
     *                         lower: 小写字母
     *                         numlower: 数字,小写字母</pre>
     *
     * @throws \Exception
     */
    public static function createNonceStr(int $length, string $dataType = 'total'): string
    {
        $resStr = '';
        switch ($dataType) {
            case 'lower':
                for ($i = 0; $i < $length; ++$i) {
                    $resStr .= self::$lowerChars[random_int(0, 23)];
                }

                break;
            case 'numlower':
                for ($i = 0; $i < $length; ++$i) {
                    $resStr .= self::$numLowerChars[random_int(0, 31)];
                }

                break;
            default:
                for ($i = 0; $i < $length; ++$i) {
                    $resStr .= self::$totalChars[random_int(0, 56)];
                }
        }

        return $resStr;
    }

    /**
     * 获取客户端IP
     *
     * @param int $model 模式类型 1:从$_SERVER获取 2:从swoole_http_request中获取
     *
     * @return bool|string
     */
    public static function getClientIP(int $model)
    {
        if (1 == $model) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

                return trim($ips[0]);
            }
            if (isset($_SERVER['HTTP_X_REAL_IP'])) {
                return trim($_SERVER['HTTP_X_REAL_IP']);
            }

            return self::getArrayVal($_SERVER, 'REMOTE_ADDR', '');
        }
        $headers = Registry::get(SyInner::REGISTRY_NAME_REQUEST_HEADER);
        $servers = Registry::get(SyInner::REGISTRY_NAME_REQUEST_SERVER);
        if ((false === $headers) || (false === $servers)) {
            return false;
        }
        if (isset($headers['x-forwarded-for'])) {
            $ips = explode(',', $headers['x-forwarded-for']);

            return trim($ips[0]);
        }
        if (isset($headers['x-real-ip'])) {
            return trim($headers['x-real-ip']);
        }
        if (isset($headers['proxy_forwarded_for'])) {
            $ips = explode(',', $headers['proxy_forwarded_for']);

            return trim($ips[0]);
        }

        return trim(self::getArrayVal($servers, 'remote_addr', ''));
    }

    /**
     * 解压zip文件
     *
     * @param string $file 文件,包括路径和名称
     * @param string $dist 解压目录
     *
     * @throws \Exception
     */
    public static function extractZip(string $file, string $dist): bool
    {
        $zip = null;

        try {
            if (!is_file($file)) {
                throw new CheckException('解压对象不是文件', ErrorCode::COMMON_PARAM_ERROR);
            }
            if (!is_readable($file)) {
                throw new CheckException('文件不可读', ErrorCode::COMMON_PARAM_ERROR);
            }
            if (!is_dir($dist)) {
                throw new CheckException('解压目录不存在', ErrorCode::COMMON_PARAM_ERROR);
            }
            if (!is_writable($dist)) {
                throw new CheckException('解压目录不可写', ErrorCode::COMMON_PARAM_ERROR);
            }

            $zip = new \ZipArchive();
            if (true !== $zip->open($file)) {
                throw new CheckException('读取文件失败', ErrorCode::COMMON_PARAM_ERROR);
            }
            if (!$zip->extractTo($dist)) {
                throw new CheckException('解压失败', ErrorCode::COMMON_PARAM_ERROR);
            }

            return true;
        } catch (\Exception $e) {
            throw $e;
        } finally {
            if ($zip) {
                $zip->close();
            }
        }
    }

    /**
     * 发送框架http任务请求
     *
     * @param string $url     请求地址
     * @param string $content 请求内容
     *
     * @return bool|mixed
     *
     * @throws \SyException\Common\CheckException
     */
    public static function sendSyHttpTaskReq(string $url, string $content)
    {
        $sendRes = self::sendCurlReq([
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => SyInner::SERVER_DATA_KEY_TASK . '=' . urlencode($content),
            CURLOPT_TIMEOUT_MS => 2000,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_RETURNTRANSFER => true,
        ]);

        return 0 == $sendRes['res_no'] ? $sendRes['res_content'] : false;
    }

    /**
     * 发送框架RPC请求
     *
     * @param string $host    请求域名
     * @param int    $port    请求端口
     * @param string $content 请求内容
     */
    public static function sendSyRpcReq(string $host, int $port, string $content): bool
    {
        $client = new Client(SWOOLE_SOCK_TCP);
        $client->set([
            'open_tcp_nodelay' => true,
            'open_length_check' => true,
            'package_length_type' => 'L',
            'package_length_offset' => 4,
            'package_body_offset' => 0,
            'package_max_length' => Project::SIZE_SERVER_PACKAGE_MAX,
            'socket_buffer_size' => Project::SIZE_CLIENT_SOCKET_BUFFER,
        ]);
        if (!@$client->connect($host, $port, 2)) {
            return false;
        }
        if (!$client->send($content)) {
            $client->close();

            return false;
        }

        $res = @$client->recv();
        $client->close();

        return $res;
    }

    /**
     * 发送curl请求
     *
     * @param array $configs       配置数组
     * @param int   $rspHeaderType 响应头类型
     *
     * @throws \SyException\Common\CheckException
     */
    public static function sendCurlReq(array $configs, int $rspHeaderType = self::CURL_RSP_HEAD_TYPE_EMPTY): array
    {
        if (!isset(self::$totalCurlRspHeadType[$rspHeaderType])) {
            throw new CheckException('响应头类型不支持', ErrorCode::COMMON_PARAM_ERROR);
        }

        $url = $configs[CURLOPT_URL] ?? '';
        if ((!\is_string($url)) || (0 == \strlen($url))) {
            throw new CheckException('请求地址不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }

        $ch = curl_init();
        foreach ($configs as $configKey => $configVal) {
            curl_setopt($ch, $configKey, $configVal);
        }

        $resArr = [
            'res_no' => 0,
            'res_msg' => '',
            'res_content' => '',
        ];

        if (self::CURL_RSP_HEAD_TYPE_EMPTY == $rspHeaderType) {
            curl_setopt($ch, CURLOPT_HEADER, false);
            $resArr['res_content'] = curl_exec($ch);
            $resArr['res_no'] = curl_errno($ch);
            $resArr['res_msg'] = curl_error($ch);
        } elseif (self::CURL_RSP_HEAD_TYPE_HTTP == $rspHeaderType) {
            curl_setopt($ch, CURLOPT_HEADER, true);
            $rspContent = curl_exec($ch);
            $resArr['res_no'] = curl_errno($ch);
            $resArr['res_msg'] = curl_error($ch);
            if (0 == $resArr['res_no']) {
                $headSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                $resArr['res_code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $resArr['res_content'] = substr($rspContent, $headSize);
                $resArr['res_header'] = [];

                $headerStr = substr($rspContent, 0, $headSize);
                $headerArr = explode("\r\n", $headerStr);
                unset($headerArr[0]);
                foreach ($headerArr as $eHeader) {
                    $pos = strpos($eHeader, ':');
                    if ($pos > 0) {
                        $headerKey = trim(substr($eHeader, 0, $pos));
                        if (!isset($resArr['res_header'][$headerKey])) {
                            $resArr['res_header'][$headerKey] = [];
                        }
                        $resArr['res_header'][$headerKey][] = trim(substr($eHeader, ($pos + 1)));
                    }
                }
                unset($headerArr);
            }
        }
        curl_close($ch);

        return $resArr;
    }

    /**
     * 获取当前时间戳
     */
    public static function getNowTime(): int
    {
        return $_SERVER[SyInner::SERVER_DATA_KEY_TIMESTAMP] ?? time();
    }

    /**
     * 读取二维码图片
     */
    public static function readQrCode(string $qrPath, string $javaPath = ''): array
    {
        $resArr = [
            'code' => 0,
        ];

        $decoder = new PHPZxingDecoder([
            'try_harder' => true,
        ]);
        if (\strlen($javaPath) > 0) {
            $decoder->setJavaPath($javaPath);
        }

        /**
         * 返回的对象类型
         * 识别成功时返回ZxingImage对象,包括
         *   getImageValue 二维码的内容
         *   getFormat 编码图像的格式
         *   getType 获取解码图像的类型，例如：URL，TEXT等
         *   getImagePath 获取图像的路径
         * 图片中没有识别的二维码时返回ZxingBarNotFound对象 包括
         *   getImageErrorCode 获取未找到图像的错误代码
         *   getErrorMessage 错误信息
         *   getImagePath 获取图像的路径
         */
        $decodedData = $decoder->decode($qrPath);
        if ($decodedData instanceof ZxingImage) {
            $resArr['data'] = $decodedData->getImageValue();
        } else {
            $resArr['code'] = ErrorCode::COMMON_PARAM_ERROR;
            $resArr['msg'] = $decodedData->getErrorMessage();
        }
        unset($decodedData, $decoder);

        return $resArr;
    }

    /**
     * 填充补位需要加密的明文
     *
     * @param string $text 需要加密的明文
     */
    public static function pkcs7Encode(string $text): string
    {
        $blockSize = 32;
        $textLength = \strlen($text);
        //计算需要填充的位数
        $addLength = $blockSize - ($textLength % $blockSize);
        if (0 == $addLength) {
            $addLength = $blockSize;
        }

        //获得补位所用的字符
        $needChr = \chr($addLength);
        $tmp = '';
        for ($i = 0; $i < $addLength; ++$i) {
            $tmp .= $needChr;
        }

        return $text . $tmp;
    }

    /**
     * 补位删除解密后的明文
     *
     * @param string $text 解密后的明文
     */
    public static function pkcs7Decode(string $text): string
    {
        $pad = \ord(substr($text, -1));
        if (($pad < 1) || ($pad > 32)) {
            $pad = 0;
        }

        return substr($text, 0, (\strlen($text) - $pad));
    }

    /**
     * 处理yaf框架需要的URI
     */
    public static function handleYafUri(string &$uri): string
    {
        if ((0 == \strlen($uri)) || ('/' == $uri)) {
            $uri = '/';

            return '';
        }
        if ('/' != substr($uri, 0, 1)) {
            return 'URI格式错误';
        }
        if ('/' == substr($uri, -1)) {
            $uri = substr($uri, 0, -1);
        }

        $tempArr = explode('/', $uri);
        if (!ctype_alnum($tempArr[1])) {
            return '模块不合法';
        }
        if (isset($tempArr[2]) && !ctype_alnum($tempArr[2])) {
            return '控制器名称不合法';
        }
        if (isset($tempArr[3]) && !ctype_alnum($tempArr[3])) {
            return '方法名称不合法';
        }

        return '';
    }

    /**
     * 执行系统命令
     */
    public static function execSystemCommand(string $command): array
    {
        $trueCommand = trim($command);
        if (0 == \strlen($trueCommand)) {
            return [
                'code' => 9999,
                'msg' => '执行命令不能为空',
            ];
        }

        $code = 0;
        $output = [];
        $msg = exec($trueCommand, $output, $code);
        if (0 == $code) {
            return [
                'code' => 0,
                'data' => $output,
            ];
        }

        return [
            'code' => $code,
            'msg' => $msg,
        ];
    }

    /**
     * 计算两个点之间的经纬度距离
     *
     * @param float $lng1 起点经度
     * @param float $lat1 起点纬度
     * @param float $lng2 终点经度
     * @param float $lat2 终点纬度
     *
     * @return int 距离,单位为米
     */
    public static function getDistance($lng1, $lat1, $lng2, $lat2): int
    {
        //将角度转为狐度
        $radLng1 = deg2rad($lng1);
        $radLat1 = deg2rad($lat1);
        $radLng2 = deg2rad($lng2);
        $radLat2 = deg2rad($lat2);
        $num1 = pow(sin(($radLat1 - $radLat2) / 2), 2);
        $num2 = pow(sin(($radLng1 - $radLng2) / 2), 2);
        $num3 = $num1 + cos($radLat1) * cos($radLat2) * $num2;

        return (int)(12756274 * asin(sqrt($num3)));
    }

    /**
     * 获取国际化文本
     *
     * @param string $tag 国际化标识
     *
     * @return string
     */
    public static function getI18nText(string $tag)
    {
        if ('i18n.' != substr($tag, 0, 5)) {
            return $tag;
        }

        $langType = ProjectTool::getLanguageType();
        $i18nKey = substr($tag, 5);
        $configKey = 'lang_' . $langType . '.' . SY_ENV . SY_PROJECT . '.' . $i18nKey;

        return self::getConfig($configKey, '', $i18nKey);
    }

    /**
     * 检测IP是否合法
     */
    public static function checkIp(string $ip): bool
    {
        return preg_match(ProjectBase::REGEX_IP, '.' . $ip) > 0;
    }

    /**
     * 检测IP是否在某个网络内
     *
     * @param string $ip      IP地址
     * @param string $network 网络IP范围,支持固定IP和网段
     */
    public static function checkIpExist(string $ip, string $network): bool
    {
        if (!self::checkIp($ip)) {
            return false;
        }

        $networkArr = explode('/', $network);
        if (!\is_array($networkArr)) {
            return false;
        }
        if (\count($networkArr) > 2) {
            return false;
        }

        $networkIp = $networkArr[0];
        if (!self::checkIp($networkIp)) {
            return false;
        }

        $networkMaskLength = isset($networkArr[1]) ? (int)$networkArr[1] : 32;
        if (($networkMaskLength <= 0) || ($networkMaskLength > 32)) {
            return false;
        }

        $ipNum = (float)ip2long($ip);
        $networkIpStart = (float)ip2long($networkIp);
        $networkIpEnd = $networkIpStart + pow(2, 32 - $networkMaskLength) - 1;
        if (($ipNum >= $networkIpStart) && ($ipNum <= $networkIpEnd)) {
            return true;
        }

        return false;
    }
}
