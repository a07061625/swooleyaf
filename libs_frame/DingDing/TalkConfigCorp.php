<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/26 0026
 * Time: 11:26
 */
namespace DingDing;

use Constant\ErrorCode;
use SyException\DingDing\TalkException;

class TalkConfigCorp
{
    /**
     * 企业ID
     * @var string
     */
    private $corpId = '';
    /**
     * 免登密钥
     * @var string
     */
    private $ssoSecret = '';
    /**
     * 应用列表
     * @var array
     */
    private $agents = [];
    /**
     * 登陆应用ID
     * @var string
     */
    private $loginAppId = '';
    /**
     * 登陆应用密钥
     * @var string
     */
    private $loginAppSecret = '';
    /**
     * 登陆应用回调地址
     * @var string
     */
    private $loginUrlCallback = '';
    /**
     * 配置有效状态
     * @var bool
     */
    private $valid = false;
    /**
     * 配置过期时间戳
     * @var int
     */
    private $expireTime = 0;

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getCorpId() : string
    {
        return $this->corpId;
    }

    /**
     * @param string $corpId
     * @throws \SyException\DingDing\TalkException
     */
    public function setCorpId(string $corpId)
    {
        if (ctype_alnum($corpId)) {
            $this->corpId = $corpId;
        } else {
            throw new TalkException('企业ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getSsoSecret() : string
    {
        return $this->ssoSecret;
    }

    /**
     * @param string $ssoSecret
     * @throws \SyException\DingDing\TalkException
     */
    public function setSsoSecret(string $ssoSecret)
    {
        if (ctype_alnum($ssoSecret)) {
            $this->ssoSecret = $ssoSecret;
        } else {
            throw new TalkException('免登密钥不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @return array
     */
    public function getAgents() : array
    {
        return $this->agents;
    }

    /**
     * @param string $agentTag
     * @return array
     * 返回数据结构:
     *   id: 应用ID
     *   key: 应用标识
     *   secret: 应用密钥
     *   token: 消息校验token
     *   aes_key: 加密密钥
     *   callback_tags: 监听事件类型列表
     *   callback_url: 回调地址
     */
    public function getAgentInfo(string $agentTag) : array
    {
        return $this->agents[$agentTag] ?? [];
    }

    /**
     * @param array $agents
     */
    public function setAgents(array $agents)
    {
        $this->agents = $agents;
    }

    /**
     * @return string
     */
    public function getLoginAppId() : string
    {
        return $this->loginAppId;
    }

    /**
     * @param string $loginAppId
     * @throws \SyException\DingDing\TalkException
     */
    public function setLoginAppId(string $loginAppId)
    {
        if (ctype_alnum($loginAppId)) {
            $this->loginAppId = $loginAppId;
        } else {
            throw new TalkException('登陆应用ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getLoginAppSecret() : string
    {
        return $this->loginAppSecret;
    }

    /**
     * @param string $loginAppSecret
     * @throws \SyException\DingDing\TalkException
     */
    public function setLoginAppSecret(string $loginAppSecret)
    {
        if (strlen($loginAppSecret) > 0) {
            $this->loginAppSecret = $loginAppSecret;
        } else {
            throw new TalkException('登陆应用密钥不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getLoginUrlCallback() : string
    {
        return $this->loginUrlCallback;
    }

    /**
     * @param string $loginUrlCallback
     * @throws \SyException\DingDing\TalkException
     */
    public function setLoginUrlCallback(string $loginUrlCallback)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $loginUrlCallback) > 0) {
            $this->loginUrlCallback = $loginUrlCallback;
        } else {
            throw new TalkException('登陆应用回调地址不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @return bool
     */
    public function isValid() : bool
    {
        return $this->valid;
    }

    /**
     * @param bool $valid
     */
    public function setValid(bool $valid)
    {
        $this->valid = $valid;
    }

    /**
     * @return int
     */
    public function getExpireTime() : int
    {
        return $this->expireTime;
    }

    /**
     * @param int $expireTime
     */
    public function setExpireTime(int $expireTime)
    {
        $this->expireTime = $expireTime;
    }
}
