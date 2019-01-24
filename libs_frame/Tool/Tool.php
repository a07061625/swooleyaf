<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/2 0002
 * Time: 11:18
 */
namespace Tool;

use Constant\ErrorCode;
use Constant\Project;
use Constant\Server;
use DesignPatterns\Factories\CacheSimpleFactory;
use Exception\Common\CheckException;
use PHPZxing\PHPZxingDecoder;
use PHPZxing\ZxingImage;
use Traits\SimpleTrait;
use Yaf\Registry;

class Tool {
    use SimpleTrait;

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
     * @return string
     */
    public static function createUniqueId() : string {
        $num = CacheSimpleFactory::getRedisInstance()->incr(Project::DATA_KEY_CACHE_UNIQUE_ID);
        return date('YmdHis') . substr($num, -8);
    }

    /**
     * 获取数组值
     * @param array $array 数组
     * @param string|int $key 键值
     * @param object $default 默认值
     * @param bool $isRecursion 是否递归查找,false:不递归 true:递归
     * @return mixed
     */
    public static function getArrayVal(array $array, $key, $default=null,bool $isRecursion=false){
        if(!$isRecursion){
            return $array[$key] ?? $default;
        }

        $index = strpos($key, '.');
        if($index === false){
            return $array[$key] ?? $default;
        }

        $keyFirst = substr($key, 0, $index);
        if(isset($array[$keyFirst]) && is_array($array[$keyFirst])){
            $keyLeft = substr($key, ($index + 1));
            $newData = $array[$keyFirst];
            unset($array);
            return self::getArrayVal($newData, $keyLeft, $default, $isRecursion);
        } else {
            return $default;
        }
    }

    /**
     * 获取配置信息
     * @param string $tag 配置标识
     * @param string $field 字段名称
     * @param mixed $default 默认值
     * @return mixed
     */
    public static function getConfig(string $tag,string $field='', $default=null){
        $configs = \Yaconf::get($tag);
        if(is_null($configs)){
            return $default;
        } else if(is_array($configs) && (strlen($field) > 0)){
            return self::getArrayVal($configs, $field, $default);
        } else {
            return $configs;
        }
    }

    /**
     * array转xml
     * @param array $dataArr
     * @return string
     * @throws \Exception\Common\CheckException
     */
    public static function arrayToXml(array $dataArr) : string {
        if (count($dataArr) == 0) {
            throw new CheckException('数组为空', ErrorCode::COMMON_PARAM_ERROR);
        }

        $xml = '<xml>';
        foreach ($dataArr as $key => $value) {
            if (is_numeric($value)) {
                $xml .= '<' . $key . '>' . $value . '</' . $key . '>';
            } else {
                $xml .= '<' . $key . '><![CDATA[' . $value . ']]></' . $key . '>';
            }
        }
        $xml .= '</xml>';
        return $xml;
    }

    /**
     * xml转为array
     * @param string $xml
     * @return array
     * @throws \Exception\Common\CheckException
     */
    public static function xmlToArray(string $xml) {
        if (strlen($xml) == 0) {
            throw new CheckException('xml数据异常', ErrorCode::COMMON_PARAM_ERROR);
        }

        $element = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $jsonStr = Tool::jsonEncode($element);
        return Tool::jsonDecode($jsonStr);
    }

    /**
     * RSA签名
     * @param string $data 待签名数据
     * @param string $private_key_path 商户私钥文件路径
     * @return string 签名结果
     */
    public static function rsaSign(string $data,string $private_key_path) : string {
        $priKey = file_get_contents($private_key_path);
        $res = openssl_get_privatekey($priKey);
        openssl_sign($data, $sign, $res);
        openssl_free_key($res);
        return base64_encode($sign);
    }

    /**
     * RSA验签
     * @param string $data 待签名数据
     * @param string $public_key_path 公钥文件路径
     * @param string $sign 要校对的的签名结果
     * @return boolean 验证结果
     */
    public static function rsaVerify(string $data,string $public_key_path,string $sign) : bool {
        $pubKey = file_get_contents($public_key_path);
        $res = openssl_get_publickey($pubKey);
        $result = (boolean)openssl_verify($data, base64_decode($sign), $res);
        openssl_free_key($res);
        return $result;
    }

    /**
     * RSA解密
     * @param string $content 需要解密的内容，密文
     * @param string $private_key_path 私钥文件路径
     * @return string 解密后内容，明文
     */
    public static function rsaDecrypt(string $content,string $private_key_path) : string {
        $priKey = file_get_contents($private_key_path);
        $res = openssl_get_privatekey($priKey);
        //用base64将内容还原成二进制
        $content2 = base64_decode($content);
        //把需要解密的内容，按128位拆开解密
        $result = '';
        $length = strlen($content2) / 128;
        for ($i = 0; $i < $length; $i++) {
            $data = substr($content2, $i * 128, 128);
            openssl_private_decrypt($data, $decrypt, $res);
            $result .= $decrypt;
        }
        openssl_free_key($res);
        return $result;
    }

    /**
     * md5签名字符串
     * @param string $needStr 需要签名的字符串
     * @param string $key 私钥
     * @return string 签名结果
     */
    public static function md5Sign(string $needStr,string $key) : string {
        return md5($needStr . $key);
    }

    /**
     * md5验证签名
     * @param string $needStr 需要签名的字符串
     * @param string $sign 签名结果
     * @param string $key 私钥
     * @return boolean 签名结果
     */
    public static function md5Verify(string $needStr,string $sign,string $key) : bool {
        $nowSign = md5($needStr . $key);
        return $nowSign === $sign;
    }

    /**
     * 加密
     * @param string $content 待加密内容
     * @param string $key 密钥
     * @return string
     */
    public static function encrypt(string $content,string $key){
        $iv = self::createNonceStr(16);
        $data = [
            'iv' => $iv,
            'value' => openssl_encrypt($content, 'AES-256-CBC', $key, 0, $iv),
        ];
        return base64_encode(self::jsonEncode($data));
    }

    /**
     * 解密
     * @param string $content 密文
     * @param string $key 密钥
     * @return bool|string
     */
    public static function decrypt(string $content,string $key){
        $data = self::jsonDecode(base64_decode($content));
        if(is_array($data) && (!empty($data))){
            return openssl_decrypt($data['value'], 'AES-256-CBC', $key, 0, $data['iv']);
        }
        return false;
    }

    /**
     * 获取命令行输入
     * @param string|int $key 键名
     * @param bool $isIndexKey 键名是否为索引 true:是索引 false:不是索引
     * @param mixed $default 默认值
     * @return mixed
     */
    public static function getClientOption($key,bool $isIndexKey=false, $default=null) {
        global $argv;

        $option = $default;
        if($isIndexKey){
            if(isset($argv[$key])){
                $option = $argv[$key];
            }
        } else {
            foreach ($argv as $eKey => $eVal) {
                if(($key == $eVal) && isset($argv[$eKey+1])){
                    $option = $argv[$eKey+1];
                    break;
                }
            }
        }

        return $option;
    }

    /**
     * 压缩数据
     * @param mixed $data 需要压缩的数据
     * @return bool|string
     */
    public static function pack($data) {
        return msgpack_pack($data);
    }

    /**
     * 解压数据
     * @param string $data 压缩数据字符串
     * @param string $className 解压类型名称
     * @return mixed
     */
    public static function unpack(string $data,string $className='array') {
        if($className == 'array'){
            return msgpack_unpack($data);
        } else {
            return msgpack_unpack($data, $className);
        }
    }

    /**
     * 序列化数据
     * @param mixed $data
     * @return string
     */
    public static function serialize($data){
        return msgpack_serialize($data);
    }

    /**
     * 反序列化数据
     * @param string $str
     * @param string $className
     * @return mixed
     */
    public static function unserialize(string $str,string $className='array'){
        if($className == 'array'){
            return msgpack_unserialize($str);
        } else {
            return msgpack_unserialize($str, $className);
        }
    }

    /**
     * 把数组转移成json字符串
     * @param array|object $arr
     * @param int|string $options
     * @return bool|string
     */
    public static function jsonEncode($arr, $options=JSON_OBJECT_AS_ARRAY){
        if(is_array($arr) || is_object($arr)){
            return json_encode($arr, $options);
        }
        return false;
    }

    /**
     * 解析json
     * @param string $json
     * @param int|string $assoc
     * @return bool|mixed
     */
    public static function jsonDecode($json, $assoc=JSON_OBJECT_AS_ARRAY){
        if(is_string($json)){
            return json_decode($json, $assoc);
        }
        return false;
    }

    /**
     * 生成随机字符串
     * @param int $length 需要获取的随机字符串长度
     * @param string $dataType 数据类型
     *   total: 数字,大小写字母
     *   lower: 小写字母
     *   numlower: 数字,小写字母
     * @return string
     */
    public static function createNonceStr(int $length,string $dataType='total') : string {
        $resStr = '';

        switch ($dataType) {
            case 'lower':
                for ($i = 0; $i < $length; $i++) {
                    $resStr .= self::$lowerChars[random_int(0, 23)];
                }
                break;
            case 'numlower':
                for ($i = 0; $i < $length; $i++) {
                    $resStr .= self::$numLowerChars[random_int(0, 31)];
                }
                break;
            default:
                for ($i = 0; $i < $length; $i++) {
                    $resStr .= self::$totalChars[random_int(0, 56)];
                }
        }

        return $resStr;
    }

    /**
     * 获取客户端IP
     * @param int $model 模式类型 1:从$_SERVER获取 2:从swoole_http_request中获取
     * @return bool|string
     */
    public static function getClientIP(int $model) {
        if($model == 1){
            if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                return trim($ips[0]);
            } else if(isset($_SERVER['HTTP_X_REAL_IP'])){
                return trim($_SERVER['HTTP_X_REAL_IP']);
            } else {
                return self::getArrayVal($_SERVER, 'REMOTE_ADDR', '');
            }
        } else {
            $headers = Registry::get(Server::REGISTRY_NAME_REQUEST_HEADER);
            $servers = Registry::get(Server::REGISTRY_NAME_REQUEST_SERVER);
            if (($headers === false) || ($servers === false)) {
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
    }

    /**
     * 解压zip文件
     * @param string $file 文件,包括路径和名称
     * @param string $dist 解压目录
     * @return bool
     * @throws \Exception
     */
    public static function extractZip(string $file,string $dist){
        $zip = null;

        try{
            if (!is_file($file)) {
                throw new CheckException('解压对象不是文件', ErrorCode::COMMON_PARAM_ERROR);
            } else if(!is_readable($file)){
                throw new CheckException('文件不可读', ErrorCode::COMMON_PARAM_ERROR);
            } else if(!is_dir($dist)){
                throw new CheckException('解压目录不存在', ErrorCode::COMMON_PARAM_ERROR);
            } else if(!is_writeable($dist)){
                throw new CheckException('解压目录不可写', ErrorCode::COMMON_PARAM_ERROR);
            }

            $zip = new \ZipArchive();
            if($zip->open($file) !== true){
                throw new CheckException('读取文件失败', ErrorCode::COMMON_PARAM_ERROR);
            }
            if(!$zip->extractTo($dist)){
                throw new CheckException('解压失败', ErrorCode::COMMON_PARAM_ERROR);
            }

            return true;
        } catch (\Exception $e){
            throw $e;
        } finally {
            if($zip){
                $zip->close();
            }
        }
    }

    /**
     * 发送框架http任务请求
     * @param string $url 请求地址
     * @param string $content 请求内容
     * @return bool|mixed
     */
    public static function sendSyHttpTaskReq(string $url,string $content) {
        $sendRes = self::sendCurlReq([
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => Server::SERVER_DATA_KEY_TASK . '=' . urlencode($content),
            CURLOPT_TIMEOUT_MS => 2000,
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_RETURNTRANSFER => true,
        ]);
        return $sendRes['res_no'] == 0 ? $sendRes['res_content'] : false;
    }

    /**
     * 发送框架RPC请求
     * @param string $host 请求域名
     * @param int $port 请求端口
     * @param string $content 请求内容
     * @return bool
     */
    public static function sendSyRpcReq(string $host,int $port,string $content) {
        $client = new \swoole_client(SWOOLE_TCP);
        $client->set([
            'open_tcp_nodelay' => true,
            'open_length_check' => true,
            'package_length_type' => 'L',
            'package_length_offset' => 4,
            'package_body_offset' => 0,
            'package_max_length' => Server::SERVER_PACKAGE_MAX_LENGTH,
            'socket_buffer_size' => Server::SERVER_PACKAGE_MAX_LENGTH,
        ]);
        if(!@$client->connect($host, $port, 2)){
            return false;
        }
        if(!$client->send($content)){
            $client->close();
            return false;
        }

        $res = @$client->recv();
        $client->close();
        return $res;
    }

    /**
     * 发送curl请求
     * @param array $configs 配置数组
     * @return array
     * @throws \Exception\Common\CheckException
     */
    public static function sendCurlReq(array $configs) {
        if (isset($configs[CURLOPT_URL]) && is_string($configs[CURLOPT_URL])) {
            $ch = curl_init();
            foreach ($configs as $configKey => $configVal) {
                curl_setopt($ch, $configKey, $configVal);
            }
            $resContent = curl_exec($ch);
            $resNo = curl_errno($ch);
            $resMsg = curl_error($ch);
            curl_close($ch);
            return [
                'res_no' => $resNo,
                'res_msg' => $resMsg,
                'res_content' => $resContent,
            ];
        } else {
            throw new CheckException('请求地址不能为空', ErrorCode::COMMON_PARAM_ERROR);
        }
    }

    /**
     * 获取当前时间戳
     * @return int
     */
    public static function getNowTime(){
        return $_SERVER[Server::SERVER_DATA_KEY_TIMESTAMP] ?? time();
    }

    /**
     * 读取二维码图片
     * @param string $qrPath
     * @param string $javaPath
     * @return array
     */
    public static function readQrCode(string $qrPath,string $javaPath=''){
        $resArr = [
            'code' => 0,
        ];

        $decoder = new PHPZxingDecoder([
            'try_harder' => true,
        ]);
        if(strlen($javaPath) > 0){
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
        if($decodedData instanceof ZxingImage){
            $resArr['data'] = $decodedData->getImageValue();
        } else {
            $resArr['code'] = ErrorCode::COMMON_PARAM_ERROR;
            $resArr['msg'] = $decodedData->getErrorMessage();
        }
        unset($decodedData, $decoder);

        return $resArr;
    }
}
