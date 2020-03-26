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

class MemberInfo extends PrintBaseFeYin
{
    /**
     * 应用ID
     * @var string
     */
    private $appid = '';
    /**
     * 商户id
     * @var string
     */
    private $uid = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    /**
     * @param string $uid
     * @throws \SyException\SyPrint\FeYinException
     */
    public function setUid(string $uid)
    {
        if (ctype_alnum($uid)) {
            $this->uid = $uid;
        } else {
            throw new FeYinException('商户id不合法', ErrorCode::PRINT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->uid) == 0) {
            throw new FeYinException('商户id不能为空', ErrorCode::PRINT_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/member/' . $this->uid . '?access_token=' . PrintUtilFeYin::getAccessToken($this->appid);
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
