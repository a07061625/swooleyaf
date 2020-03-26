<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-28
 * Time: 上午11:15
 */
namespace DingDing\Corp\Sns;

use SyConstant\ErrorCode;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use DingDing\TalkUtilBase;
use DingDing\TalkUtilCorp;
use DingDing\TalkUtilProvider;
use SyException\DingDing\TalkException;
use SyTool\Tool;

/**
 * 获取用户授权的令牌
 * @package DingDing\Corp\Sns
 */
class SnsTokenGet extends TalkBaseCorp
{
    use TalkTraitCorp;

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
            $this->reqData['openid'] = $openid;
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
            $this->reqData['persistent_code'] = $persistentCode;
        } else {
            throw new TalkException('持久授权码不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['openid'])) {
            throw new TalkException('用户openid不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (!isset($this->reqData['persistent_code'])) {
            throw new TalkException('持久授权码不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        if (strlen($this->_corpId) > 0) {
            $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/sns/get_sns_token?' . http_build_query([
                'access_token' => TalkUtilCorp::getSnsToken($this->_corpId),
            ]);
        } else {
            $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/sns/get_sns_token?' . http_build_query([
                'access_token' => TalkUtilProvider::getSnsToken(),
            ]);
        }
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = TalkUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (!is_array($sendData)) {
            throw new TalkException('获取用户授权令牌出错', ErrorCode::DING_TALK_POST_ERROR);
        } elseif (!isset($sendData['sns_token'])) {
            throw new TalkException($sendData['errmsg'], ErrorCode::DING_TALK_POST_ERROR);
        }

        return $sendData;
    }
}
