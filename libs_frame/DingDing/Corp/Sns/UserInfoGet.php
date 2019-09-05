<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-28
 * Time: 下午4:45
 */
namespace DingDing\Corp\Sns;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkUtilCorp;
use DingDing\TalkUtilProvider;
use SyException\DingDing\TalkException;

/**
 * 获取授权用户的个人信息
 * @package DingDing\Corp\Sns
 */
class UserInfoGet extends TalkBaseCorp
{
    /**
     * 用户openid
     * @var string
     */
    private $openid = '';
    /**
     * 持久授权码
     * @var string
     */
    private $persistent_code = '';

    public function __construct(string $corpId)
    {
        parent::__construct();
        $this->_corpId = $corpId;
    }

    private function __clone()
    {
    }

    /**
     * @param string $openid
     * @throws \SyException\DingDing\TalkException
     */
    public function setOpenid(string $openid)
    {
        if (ctype_alnum($openid)) {
            $this->openid = $openid;
        } else {
            throw new TalkException('用户openid不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $persistentCode
     * @throws \SyException\DingDing\TalkException
     */
    public function setPersistentCode(string $persistentCode)
    {
        if (ctype_alnum($persistentCode)) {
            $this->persistent_code = $persistentCode;
        } else {
            throw new TalkException('持久授权码不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->openid) == 0) {
            throw new TalkException('用户openid不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (strlen($this->persistent_code) == 0) {
            throw new TalkException('持久授权码不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        if (strlen($this->_corpId) > 0) {
            $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/sns/getuserinfo?' . http_build_query([
                'sns_token' => TalkUtilCorp::getUserSnsToken($this->_corpId, $this->openid, $this->persistent_code),
            ]);
        } else {
            $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/sns/getuserinfo?' . http_build_query([
                'sns_token' => TalkUtilProvider::getUserSnsToken($this->openid, $this->persistent_code),
            ]);
        }
        return $this->sendRequest('GET');
    }
}
