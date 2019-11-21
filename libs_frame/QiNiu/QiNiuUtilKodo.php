<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/11/21 0021
 * Time: 18:03
 */
namespace QiNiu;

use SyConstant\ErrorCode;
use SyTrait\SimpleTrait;
use Tool\Tool;

final class QiNiuUtilKodo extends QiNiuUtilBase
{
    use SimpleTrait;

    /**
     * 发送服务请求
     * @param \QiNiu\QiNiuBaseKodo $baseService
     * @return array
     */
    public static function sendServiceRequest(QiNiuBaseKodo $baseService)
    {
        $resArr = [
            'code' => 0,
        ];

        $sendRes = self::sendCurl($baseService->getDetail());
        if ($sendRes === false) {
            $resArr['code'] = ErrorCode::QINIU_KODO_PARAM_ERROR;
            $resArr['message'] = '发送请求出错';
        }

        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['code']) && ($sendData['code'] > 200)) {
            $resArr['code'] = ErrorCode::QINIU_KODO_PARAM_ERROR;
            $resArr['message'] = $sendData['error'];
        } elseif (is_array($sendData)) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::QINIU_KODO_PARAM_ERROR;
            $resArr['message'] = '解析响应数据出错';
        }

        return $resArr;
    }
}
