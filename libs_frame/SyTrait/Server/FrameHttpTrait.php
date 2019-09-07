<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/2/22 0022
 * Time: 17:53
 */
namespace SyTrait\Server;

use SyConstant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use Tool\Tool;

trait FrameHttpTrait
{
    /**
     * 添加签名缓存
     * @param string $sign 签名信息
     * @return bool
     */
    public static function addApiSign(string $sign) : bool
    {
        $signKey = Project::YAC_PREFIX_API_SIGN . substr($sign, 0, 16);
        $cacheData = CacheSimpleFactory::getYacInstance()->get($signKey);
        if (is_string($cacheData)) {
            return false;
        } else {
            CacheSimpleFactory::getYacInstance()->set($signKey, '1', Project::TIME_EXPIRE_LOCAL_API_SIGN_CACHE);
            return true;
        }
    }

    private function checkServerHttp()
    {
        $this->checkServerBase();
        $this->checkServerHttpTrait();
    }

    private function initTableHttp()
    {
        $this->initTableBase();
        $this->initTableHttpTrait();
    }

    private function getTokenExpireTime() : int
    {
        $expireTime = 0;
        if (ctype_digit(substr(SY_TOKEN, 0, 1))) {
            $expireTime = time() + 86400;
        } elseif (strlen(SY_URL_TOKEN_REFRESH) > 0) {
            $sendRes = Tool::sendCurlReq([
                CURLOPT_URL => SY_URL_TOKEN_REFRESH . SY_TOKEN,
                CURLOPT_TIMEOUT_MS => 2000,
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
            ]);
            if ($sendRes['res_no'] > 0) {
                return $expireTime;
            }
            $resData = Tool::jsonDecode($sendRes['res_content']);
            if (isset($resData['data']['expire_time']) && is_numeric($resData['data']['expire_time'])) {
                $expireTime = (int)$resData['data']['expire_time'];
            }
        }

        return $expireTime;
    }
}
