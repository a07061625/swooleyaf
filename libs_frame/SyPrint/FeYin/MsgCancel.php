<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/11 0011
 * Time: 8:14
 */
namespace SyPrint\FeYin;

use SyConstant\ErrorCode;
use SyException\SyPrint\FeYinException;
use SyPrint\PrintBaseFeYin;
use SyPrint\PrintUtilBase;
use SyPrint\PrintUtilFeYin;
use SyTool\Tool;

class MsgCancel extends PrintBaseFeYin
{
    /**
     * 应用ID
     * @var string
     */
    private $appid = '';
    /**
     * 消息ID
     * @var string
     */
    private $msg_no = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    /**
     * @param string $msgNo
     * @throws \SyException\SyPrint\FeYinException
     */
    public function setMsgNo(string $msgNo)
    {
        if (ctype_alnum($msgNo)) {
            $this->msg_no = $msgNo;
        } else {
            throw new FeYinException('消息ID不合法', ErrorCode::PRINT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->msg_no) == 0) {
            throw new FeYinException('消息ID不能为空', ErrorCode::PRINT_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/msg/' . $this->msg_no . '/cancel?access_token=' . PrintUtilFeYin::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = '[]';
        $this->curlConfigs[CURLOPT_HTTPHEADER] = [
            'Content-Type: application/json; charset=utf-8',
        ];
        $sendRes = PrintUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::PRINT_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
