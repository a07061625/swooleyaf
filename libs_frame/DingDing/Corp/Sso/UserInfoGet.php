<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-27
 * Time: 下午2:29
 */
namespace DingDing\Corp\Sso;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkUtilCorp;
use DingDing\TalkUtilProvider;
use SyException\DingDing\TalkException;

/**
 * 获取应用管理员的身份信息
 * @package DingDing\Corp\Sso
 */
class UserInfoGet extends TalkBaseCorp
{
    /**
     * 授权码
     * @var string
     */
    private $code = '';

    public function __construct(string $corpId)
    {
        parent::__construct();
        if (strlen($corpId) > 0) {
            $this->reqData['access_token'] = TalkUtilCorp::getSsoToken($corpId);
        } else {
            $this->reqData['access_token'] = TalkUtilProvider::getSsoToken();
        }
    }

    private function __clone()
    {
    }

    /**
     * @param string $code
     * @throws \SyException\DingDing\TalkException
     */
    public function setCode(string $code)
    {
        if (ctype_alnum($code)) {
            $this->reqData['code'] = $code;
        } else {
            throw new TalkException('授权码不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['code'])) {
            throw new TalkException('授权码不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/sso/getuserinfo?' . http_build_query($this->reqData);
        return $this->sendRequest('GET');
    }
}
