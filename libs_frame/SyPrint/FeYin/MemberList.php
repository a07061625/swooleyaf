<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/11 0011
 * Time: 8:14
 */
namespace SyPrint\FeYin;

use SyConstant\ErrorCode;
use SyPrint\PrintBaseFeYin;
use SyPrint\PrintUtilBase;
use SyPrint\PrintUtilFeYin;
use SyTool\Tool;

class MemberList extends PrintBaseFeYin
{
    /**
     * 应用id
     * @var string
     */
    private $appid = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/app/' . $this->appid . '/members?access_token=' . PrintUtilFeYin::getAccessToken($this->appid);
        $sendRes = PrintUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['errcode'])) {
            $resArr['code'] = ErrorCode::PRINT_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}
