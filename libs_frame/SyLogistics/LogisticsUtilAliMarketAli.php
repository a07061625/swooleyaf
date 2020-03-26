<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/18 0018
 * Time: 16:36
 */
namespace SyLogistics;

use SyConstant\ErrorCode;
use SyTool\Tool;
use SyTrait\SimpleTrait;

abstract class LogisticsUtilAliMarketAli extends LogisticsUtilBase
{
    use SimpleTrait;

    /**
     * 发送服务请求
     * @param \SyLogistics\LogisticsBaseAliMarketAli $logisticsBase
     * @return array
     */
    public static function sendServiceRequest(LogisticsBaseAliMarketAli $logisticsBase)
    {
        $resArr = [
            'code' => 0
        ];
        
        $curlConfigs = $logisticsBase->getDetail();
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = ErrorCode::LOGISTICS_REQ_ALIMARKET_ALI_ERROR;
            $resArr['msg'] = $sendRes['res_msg'];
            return $resArr;
        }
        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($rspData['showapi_res_code']) && ($rspData['showapi_res_code'] == 0)) {
            if ($rspData['showapi_res_body']['ret_code'] == 0) {
                $resArr['data'] = $rspData['showapi_res_body'];
            } else {
                $resArr['code'] = ErrorCode::LOGISTICS_REQ_ALIMARKET_ALI_ERROR;
                $resArr['msg'] = $rspData['showapi_res_body']['msg'];
            }
        } elseif (isset($rspData['showapi_res_error'])) {
            $resArr['code'] = ErrorCode::LOGISTICS_REQ_ALIMARKET_ALI_ERROR;
            $resArr['msg'] = $rspData['showapi_res_error'];
        } else {
            $resArr['code'] = ErrorCode::LOGISTICS_REQ_ALIMARKET_ALI_ERROR;
            $resArr['msg'] = '解析响应数据出错';
        }
        return $resArr;
    }
}
