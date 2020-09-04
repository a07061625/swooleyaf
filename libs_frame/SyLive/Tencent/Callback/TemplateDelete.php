<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 17:36
 */
namespace SyLive\Tencent\Callback;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 删除回调模板
 *
 * @package SyLive\Tencent\Callback
 */
class TemplateDelete extends BaseTencent
{
    /**
     * 模板ID
     *
     * @var int
     */
    private $TemplateId = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DeleteLiveCallbackTemplate';
    }

    private function __clone()
    {
    }

    /**
     * @param int $templateId
     *
     * @throws \SyException\Live\TencentException
     */
    public function setTemplateId(int $templateId)
    {
        if ($templateId > 0) {
            $this->reqData['TemplateId'] = $templateId;
        } else {
            throw new TencentException('模板ID不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['TemplateId'])) {
            throw new TencentException('模板ID不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
