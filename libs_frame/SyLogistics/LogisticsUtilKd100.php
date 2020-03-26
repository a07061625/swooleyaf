<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/19 0019
 * Time: 8:49
 */
namespace SyLogistics;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\LogisticsConfigSingleton;
use SyTool\Tool;
use SyTrait\SimpleTrait;

abstract class LogisticsUtilKd100
{
    use SimpleTrait;

    protected static $urlHttps = 'https://poll.kuaidi100.com/poll/query.do';

    /**
     * 生成签名
     * @param array $data
     * @return array
     */
    public static function createSign(array $data)
    {
        $config = LogisticsConfigSingleton::getInstance()->getKd100Config();
        $signRes = [
            'customer' => $config->getAppId(),
            'param' => Tool::jsonEncode($data, JSON_UNESCAPED_UNICODE),
        ];
        $sign = md5($signRes['param'] . $config->getAppKey() . $config->getAppId());
        $signRes['sign'] = strtoupper($sign);
        return $signRes;
    }

    /**
     * 发送服务请求
     * @param \SyLogistics\LogisticsBaseKd100 $logisticsBase
     * @return array
     */
    public static function sendServiceRequest(LogisticsBaseKd100 $logisticsBase)
    {
        $resArr = [
            'code' => 0
        ];

        $curlConfigs = $logisticsBase->getDetail();
        $curlConfigs[CURLOPT_URL] = self::$urlHttps;
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = ErrorCode::LOGISTICS_REQ_KD100_ERROR;
            $resArr['msg'] = $sendRes['res_msg'];
            return $resArr;
        }
        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if ($rspData['status'] == 200) {
            $resArr['data'] = $rspData;
        } else {
            $resArr['code'] = ErrorCode::LOGISTICS_REQ_KD100_ERROR;
            $resArr['msg'] = $rspData['message'];
        }
        return $resArr;
    }
}
