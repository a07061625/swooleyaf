<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-14
 * Time: 下午1:15
 */
namespace SyMap;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\MapSingleton;
use SyTool\Tool;
use SyTrait\SimpleTrait;

final class MapUtilGaoDe extends MapUtilBase
{
    use SimpleTrait;

    /**
     * 生成数字签名
     * @param array $data
     */
    public static function createSign(array &$data)
    {
        unset($data['sig']);
        ksort($data);
        $needStr1 = '';
        foreach ($data as $key => $value) {
            $needStr1 .= '&' . $key . '=' . $value;
        }
        $needStr2 = substr($needStr1, 1) . MapSingleton::getInstance()->getGaoDeConfig()->getSecret();
        $data['sig'] = md5($needStr2);
    }

    /**
     * 发送服务请求
     * @param \SyMap\MapBaseGaoDe $mapBase
     * @return array
     */
    public static function sendServiceRequest(MapBaseGaoDe $mapBase)
    {
        $resArr = [
            'code' => 0,
        ];

        $sendRes = self::sendCurl($mapBase->getDetail());
        if ($sendRes === false) {
            $resArr['code'] = ErrorCode::MAP_GAODE_PARAM_ERROR;
            $resArr['message'] = '发送请求出错';
        }

        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['status']) && ($sendData['status'] == 1)) {
            $resArr['data'] = $sendData;
        } elseif (isset($sendData['info'])) {
            $resArr['code'] = ErrorCode::MAP_GAODE_PARAM_ERROR;
            $resArr['message'] = $sendData['info'];
        } else {
            $resArr['code'] = ErrorCode::MAP_GAODE_PARAM_ERROR;
            $resArr['message'] = '解析响应数据出错';
        }

        return $resArr;
    }
}
