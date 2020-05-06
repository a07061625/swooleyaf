<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/23 0023
 * Time: 9:01
 */
namespace SyIot;

use SyConstant\ErrorCode;
use SyTool\Tool;
use SyTrait\SimpleTrait;

abstract class IotUtilTencent extends IotUtilBase
{
    use SimpleTrait;

    /**
     * 发送服务请求
     * @param \SyIot\IotBaseTencent $iotBase
     * @return array
     */
    public static function sendServiceRequest(IotBaseTencent $iotBase)
    {
        $resArr = [
            'code' => 0
        ];

        $curlConfigs = $iotBase->getDetail();
        $sendRes = Tool::sendCurlReq($curlConfigs);
        if ($sendRes['res_no'] > 0) {
            $resArr['code'] = ErrorCode::IOT_REQ_TENCENT_ERROR;
            $resArr['msg'] = $sendRes['res_msg'];
            return $resArr;
        }
        $rspData = Tool::jsonDecode($sendRes['res_content']);
        if (isset($rspData['Response'])) {
            if (isset($rspData['Response']['Error'])) {
                $resArr['code'] = ErrorCode::IOT_REQ_TENCENT_ERROR;
                $resArr['msg'] = $rspData['Response']['Error']['Message'];
            } else {
                $resArr['data'] = $rspData['Response'];
            }
        } else {
            $resArr['code'] = ErrorCode::IOT_REQ_TENCENT_ERROR;
            $resArr['msg'] = '解析响应数据出错';
        }
        return $resArr;
    }
}
