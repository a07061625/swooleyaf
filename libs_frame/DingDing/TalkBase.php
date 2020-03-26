<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/26 0026
 * Time: 8:57
 */
namespace DingDing;

use SyConstant\ErrorCode;
use SyTool\Tool;

abstract class TalkBase
{
    /**
     * 服务域名
     * @var string
     */
    protected $serviceDomain = '';
    /**
     * 请求数据
     * @var array
     */
    protected $reqData = [];
    /**
     * curl配置数组
     * @var array
     */
    protected $curlConfigs = [];

    public function __construct()
    {
        $this->serviceDomain = 'https://oapi.dingtalk.com';
    }

    abstract public function getDetail() : array;

    /**
     * 发送请求
     * @param string $reqMethod 请求方式 GET POST
     * @return array
     */
    protected function sendRequest(string $reqMethod) : array
    {
        $resArr = [
            'code' => 0,
        ];

        if ($reqMethod == 'GET') {
            $errorCode = ErrorCode::DING_TALK_GET_ERROR;
            $sendRes = TalkUtilBase::sendGetReq($this->curlConfigs);
        } else {
            $errorCode = ErrorCode::DING_TALK_POST_ERROR;
            $sendRes = TalkUtilBase::sendPostReq($this->curlConfigs);
        }
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = $errorCode;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
