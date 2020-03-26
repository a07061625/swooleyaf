<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/6/18 0018
 * Time: 16:36
 */
namespace SyCurrency;

use SyConstant\ErrorCode;
use SyTool\Tool;
use SyTrait\SimpleTrait;

abstract class UtilAliMarketYiYuan extends UtilCommon
{
    use SimpleTrait;

    /**
     * 发送服务请求
     * @param \SyCurrency\BaseAliMarketYiYuan $aliMarketYiYuan
     * @return array
     */
    public static function sendServiceRequest(BaseAliMarketYiYuan $aliMarketYiYuan)
    {
        $resArr = [
            'code' => 0
        ];
        
        $curlConfigs = $aliMarketYiYuan->getDetail();
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = ErrorCode::CURRENCY_REQ_ALIMARKET_YIYUAN_ERROR;
            $resArr['msg'] = $sendRes['res_msg'];
            return $resArr;
        }
        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($rspData['showapi_res_code']) && ($rspData['showapi_res_code'] == 0)) {
            if (isset($rspData['showapi_res_body']['ret_code']) && ($rspData['showapi_res_body']['ret_code'] > 0)) {
                $resArr['code'] = ErrorCode::CURRENCY_REQ_ALIMARKET_YIYUAN_ERROR;
                $resArr['msg'] = $rspData['showapi_res_body']['msg'];
            } else {
                $resArr['data'] = $rspData['showapi_res_body'];
            }
        } elseif (isset($rspData['showapi_res_error'])) {
            $resArr['code'] = ErrorCode::CURRENCY_REQ_ALIMARKET_YIYUAN_ERROR;
            $resArr['msg'] = $rspData['showapi_res_error'];
        } else {
            $resArr['code'] = ErrorCode::CURRENCY_REQ_ALIMARKET_YIYUAN_ERROR;
            $resArr['msg'] = '解析响应数据出错';
        }
        return $resArr;
    }
}
