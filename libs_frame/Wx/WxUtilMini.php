<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 17:04
 */
namespace Wx;

use SyConstant\ErrorCode;
use SyTool\Tool;
use SyTrait\SimpleTrait;

final class WxUtilMini extends WxUtilBase
{
    use SimpleTrait;

    /**
     * 解密小程序数据
     * @param string $encryptedData 加密数据
     * @param string $iv 初始向量
     * @param string $sessionKey 会话密钥
     * @param string $appId 小程序应用ID
     * @return array
     */
    public static function decryptData(string $encryptedData, string $iv, string $sessionKey, string $appId)
    {
        $resArr = [
            'code' => 0
        ];

        if (strlen($iv) != 24) {
            $resArr['code'] = ErrorCode::WX_PARAM_ERROR;
            $resArr['message'] = '初始向量不合法';
            return $resArr;
        } elseif (strlen($sessionKey) != 24) {
            $resArr['code'] = ErrorCode::WX_PARAM_ERROR;
            $resArr['message'] = '会话密钥不合法';
            return $resArr;
        }

        $aesIV = base64_decode($iv);
        $aesKey = base64_decode($sessionKey);
        $aesCipher = base64_decode($encryptedData);
        $decryptData = Tool::jsonDecode(openssl_decrypt($aesCipher, 'AES-128-CBC', $aesKey, 1, $aesIV));
        if (is_array($decryptData) && isset($decryptData['watermark']['appid']) && ($decryptData['watermark']['appid'] == $appId)) {
            $resArr['data'] = $decryptData;
        } else {
            $resArr['code'] = ErrorCode::WX_PARAM_ERROR;
            $resArr['message'] = '解密用户数据失败';
        }

        return $resArr;
    }
}
