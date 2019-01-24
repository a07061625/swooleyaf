<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-9
 * Time: 下午12:44
 */
namespace Map;

use Constant\ErrorCode;
use Tool\Tool;
use Traits\SimpleTrait;

final class MapUtilTencent extends MapUtilBase {
    use SimpleTrait;

    public static function sendServiceRequest(MapBaseTencent $mapBase){
        $resArr = [
            'code' => 0,
        ];

        $sendRes = self::sendCurl($mapBase->getDetail());
        if($sendRes === false){
            $resArr['code'] = ErrorCode::MAP_TENCENT_PARAM_ERROR;
            $resArr['message'] = '发送请求出错';
        }

        $sendData = Tool::jsonDecode($sendRes);
        if(isset($sendData['status']) && ($sendData['status'] == 0)){
            $rspKey = $mapBase->getRspDataKey();
            $resArr['data'] = strlen($rspKey) > 0 ? $sendData[$rspKey] : $sendData;
        } else if(isset($sendData['message'])){
            $resArr['code'] = ErrorCode::MAP_TENCENT_PARAM_ERROR;
            $resArr['message'] = $sendData['message'];
        } else {
            $resArr['code'] = ErrorCode::MAP_TENCENT_PARAM_ERROR;
            $resArr['message'] = '解析响应数据出错';
        }

        return $resArr;
    }
}