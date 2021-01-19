<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/26 0026
 * Time: 11:26
 */

namespace DingDing;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\DingDing\TalkException;
use SyTrait\SimpleConfigTrait;

class TalkConfigCorp
{
    use SimpleConfigTrait;

    /**
     * 企业ID
     *
     * @var string
     */
    private $corpId = '';
    /**
     * 免登密钥
     *
     * @var string
     */
    private $ssoSecret = '';
    /**
     * 应用列表
     *
     * @var array
     */
    private $agents = [];
    /**
     * 登陆应用ID
     *
     * @var string
     */
    private $loginAppId = '';
    /**
     * 登陆应用密钥
     *
     * @var string
     */
    private $loginAppSecret = '';
    /**
     * 登陆应用回调地址
     *
     * @var string
     */
    private $loginUrlCallback = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    public function getCorpId(): string
    {
        return $this->corpId;
    }

    /**
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

    public function getSsoSecret(): string
    {
        return $this->ssoSecret;
    }

    /**
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

    public function getAgents(): array
    {
        return $this->agents;
    }

    /**
     * @return array
     *               返回数据结构:
     *               id: 应用ID
     *               key: 应用标识
     *               secret: 应用密钥
     *               token: 消息校验token
     *               aes_key: 加密密钥
     *               callback_tags: 监听事件类型列表
     *               callback_url: 回调地址
     */
    public function getAgentInfo(string $agentTag): array
    {
        return $this->agents[$agentTag] ?? [];
    }

    public function setAgents(array $agents)
    {
        $this->agents = $agents;
    }

    public function getLoginAppId(): string
    {
        return $this->loginAppId;
    }

    /**
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

    public function getLoginAppSecret(): string
    {
        return $this->loginAppSecret;
    }

    /**
     * @throws \SyException\DingDing\TalkException
     */
    public function setLoginAppSecret(string $loginAppSecret)
    {
        if (\strlen($loginAppSecret) > 0) {
            $this->loginAppSecret = $loginAppSecret;
        } else {
            throw new TalkException('登陆应用密钥不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getLoginUrlCallback(): string
    {
        return $this->loginUrlCallback;
    }

    /**
     * @throws \SyException\DingDing\TalkException
     */
    public function setLoginUrlCallback(string $loginUrlCallback)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $loginUrlCallback) > 0) {
            $this->loginUrlCallback = $loginUrlCallback;
        } else {
            throw new TalkException('登陆应用回调地址不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }
}
