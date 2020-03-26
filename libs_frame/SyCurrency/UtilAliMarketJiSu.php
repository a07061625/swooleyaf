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

abstract class UtilAliMarketJiSu extends UtilCommon
{
    use SimpleTrait;

    /**
     * 发送服务请求
     * @param \SyCurrency\BaseAliMarketJiSu $aliMarketJiSu
     * @return array
     */
    public static function sendServiceRequest(BaseAliMarketJiSu $aliMarketJiSu)
    {
        $resArr = [
            'code' => 0
        ];
        
        $curlConfigs = $aliMarketJiSu->getDetail();
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = ErrorCode::CURRENCY_REQ_ALIMARKET_JISU_ERROR;
            $resArr['msg'] = $sendRes['res_msg'];
            return $resArr;
        }
        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($rspData['status']) && ($rspData['status'] == 0)) {
            $resArr['data'] = $rspData['result'];
        } elseif (isset($rspData['msg'])) {
            $resArr['code'] = ErrorCode::CURRENCY_REQ_ALIMARKET_JISU_ERROR;
            $resArr['msg'] = $rspData['msg'];
        } else {
            $resArr['code'] = ErrorCode::CURRENCY_REQ_ALIMARKET_JISU_ERROR;
            $resArr['msg'] = '解析响应数据出错';
        }
        return $resArr;
    }
}
