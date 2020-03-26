<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/28 0028
 * Time: 19:55
 */
namespace SyLogistics;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\LogisticsConfigSingleton;
use SyTool\Tool;
use SyTrait\SimpleTrait;

abstract class LogisticsUtilKdNiao extends LogisticsUtilBase
{
    use SimpleTrait;

    /**
     * 生成签名
     * @param array $data
     * @return array
     */
    public static function createSign(array $data)
    {
        $resArr = [
            'encode_data' => Tool::jsonEncode($data, JSON_UNESCAPED_UNICODE),
        ];
        $appKey = LogisticsConfigSingleton::getInstance()->getKdNiaoConfig()->getAppKey();
        $resArr['sign'] = base64_encode(md5($resArr['encode_data'] . $appKey));
        return $resArr;
    }

    /**
     * 发送服务请求
     * @param \SyLogistics\LogisticsBaseKdNiao $logisticsBase
     * @return array
     */
    public static function sendServiceRequest(LogisticsBaseKdNiao $logisticsBase)
    {
        $resArr = [
            'code' => 0
        ];

        $curlConfigs = $logisticsBase->getDetail();
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = ErrorCode::LOGISTICS_REQ_KDNIAO_ERROR;
            $resArr['msg'] = $sendRes['res_msg'];
            return $resArr;
        }
        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($rspData['Success']) && $rspData['Success']) {
            $resArr['data'] = $rspData;
        } elseif (isset($rspData['Reason'])) {
            $resArr['code'] = ErrorCode::LOGISTICS_REQ_KDNIAO_ERROR;
            $resArr['msg'] = $rspData['Reason'];
        } else {
            $resArr['code'] = ErrorCode::LOGISTICS_REQ_KDNIAO_ERROR;
            $resArr['msg'] = '解析响应数据出错';
        }
        return $resArr;
    }
}
