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
 * 修改推流鉴权key
 *
 * @package SyLive\Tencent\Auth
 */
class PushKeyModify extends BaseTencent
{
    /**
     * 推流域名
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
     * 主鉴权key
     *
     * @var string
     */
    private $MasterAuthKey = '';
    /**
     * 备鉴权key
     *
     * @var string
     */
    private $BackupAuthKey = '';
    /**
     * 有效时间,单位为秒
     *
     * @var int
     */
    private $AuthDelta = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'ModifyLivePushAuthKey';
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
            throw new TencentException('推流域名不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
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
     * @param string $masterAuthKey
     *
     * @throws \SyException\Live\TencentException
     */
    public function setMasterAuthKey(string $masterAuthKey)
    {
        if (strlen($masterAuthKey) > 0) {
            $this->reqData['MasterAuthKey'] = $masterAuthKey;
        } else {
            throw new TencentException('主鉴权key不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $backupAuthKey
     *
     * @throws \SyException\Live\TencentException
     */
    public function setBackupAuthKey(string $backupAuthKey)
    {
        if (strlen($backupAuthKey) > 0) {
            $this->reqData['BackupAuthKey'] = $backupAuthKey;
        } else {
            throw new TencentException('备鉴权key不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
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
            throw new TencentException('推流域名不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
