<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/4 0004
 * Time: 8:33
 */
namespace SyLive\Tencent\Auth;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 修改播放鉴权key
 *
 * @package SyLive\Tencent\Auth
 */
class PlayKeyModify extends BaseTencent
{
    /**
     * 播放域名
     *
     * @var string
     */
    private $DomainName = '';
    /**
     * 启用标识
     *
     * @var int
     */
    private $Enable = 0;
    /**
     * 鉴权key
     *
     * @var string
     */
    private $AuthKey = '';
    /**
     * 鉴权备用key
     *
     * @var string
     */
    private $AuthBackKey = '';
    /**
     * 有效时间,单位为秒
     *
     * @var int
     */
    private $AuthDelta = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'ModifyLivePlayAuthKey';
    }

    private function __clone()
    {
    }

    /**
     * @param string $domainName
     *
     * @throws \SyException\Live\TencentException
     */
    public function setDomainName(string $domainName)
    {
        if (strlen($domainName) > 0) {
            $this->reqData['DomainName'] = $domainName;
        } else {
            throw new TencentException('播放域名不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $enable
     *
     * @throws \SyException\Live\TencentException
     */
    public function setEnable(int $enable)
    {
        if (in_array($enable, [0, 1])) {
            $this->reqData['Enable'] = $enable;
        } else {
            throw new TencentException('启用标识不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $authKey
     *
     * @throws \SyException\Live\TencentException
     */
    public function setAuthKey(string $authKey)
    {
        if (strlen($authKey) > 0) {
            $this->reqData['AuthKey'] = $authKey;
        } else {
            throw new TencentException('鉴权key不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $authBackKey
     *
     * @throws \SyException\Live\TencentException
     */
    public function setAuthBackKey(string $authBackKey)
    {
        if (strlen($authBackKey) > 0) {
            $this->reqData['AuthBackKey'] = $authBackKey;
        } else {
            throw new TencentException('鉴权备用key不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $authDelta
     *
     * @throws \SyException\Live\TencentException
     */
    public function setAuthDelta(int $authDelta)
    {
        if (strlen($authDelta) > 0) {
            $this->reqData['AuthDelta'] = $authDelta;
        } else {
            throw new TencentException('有效时间不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['DomainName'])) {
            throw new TencentException('播放域名不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
