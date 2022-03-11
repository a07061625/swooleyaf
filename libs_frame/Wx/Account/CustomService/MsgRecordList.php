<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/20 0020
 * Time: 10:52
 */

namespace Wx\Account\CustomService;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class MsgRecordList extends WxBaseAccount
{
    /**
     * 公众号ID
     *
     * @var string
     */
    private $appid = '';
    /**
     * 起始时间
     *
     * @var int
     */
    private $starttime = 0;
    /**
     * 结束时间
     *
     * @var int
     */
    private $endtime = 0;
    /**
     * 消息id
     *
     * @var int
     */
    private $msgid = 0;
    /**
     * 条数
     *
     * @var int
     */
    private $number = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/customservice/msgrecord/getmsglist?access_token=';
        $this->appid = $appId;
        $this->reqData['msgid'] = 1;
        $this->reqData['number'] = 100;
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setTime(int $startTime, int $endTime)
    {
        if ($startTime <= 0) {
            throw new WxException('起始时间不合法', ErrorCode::WX_PARAM_ERROR);
        }
        if ($endTime <= 0) {
            throw new WxException('结束时间不合法', ErrorCode::WX_PARAM_ERROR);
        }
        if ($startTime >= $endTime) {
            throw new WxException('起始时间必须小于结束时间', ErrorCode::WX_PARAM_ERROR);
        }
        if (($endTime - $startTime) > 86400) {
            throw new WxException('结束时间不能超过起始时间24小时', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['starttime'] = $startTime;
        $this->reqData['endtime'] = $endTime;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setMsgid(int $msgId)
    {
        if ($msgId > 0) {
            $this->reqData['msgid'] = $msgId;
        } else {
            throw new WxException('消息id不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setNumber(int $number)
    {
        if (($number > 0) && ($number <= 10000)) {
            $this->reqData['number'] = $number;
        } else {
            throw new WxException('条数不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['starttime'])) {
            throw new WxException('起始时间不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAccount::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['recordlist'])) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
