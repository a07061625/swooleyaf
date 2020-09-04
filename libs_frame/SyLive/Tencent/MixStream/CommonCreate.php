<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 22:56
 */
namespace SyLive\Tencent\MixStream;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 创建通用混流
 *
 * @package SyLive\Tencent\MixStream
 */
class CommonCreate extends BaseTencent
{
    /**
     * 会话ID
     *
     * @var string
     */
    private $MixStreamSessionId = '';
    /**
     * 输入流列表
     *
     * @var array
     */
    private $InputStreamList = [];
    /**
     * 输出流参数
     *
     * @var array
     */
    private $OutputParams = [];
    /**
     * 输入模板ID
     *
     * @var int
     */
    private $MixStreamTemplateId = 0;
    /**
     * 特殊控制参数
     *
     * @var array
     */
    private $ControlParams = [];

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'CreateCommonMixStream';
        $this->reqData['MixStreamTemplateId'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param string $mixStreamSessionId
     *
     * @throws \SyException\Live\TencentException
     */
    public function setMixStreamSessionId(string $mixStreamSessionId)
    {
        if (strlen($mixStreamSessionId) > 0) {
            $this->reqData['MixStreamSessionId'] = $mixStreamSessionId;
        } else {
            throw new TencentException('会话ID不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param array $inputStreamList
     *
     * @throws \SyException\Live\TencentException
     */
    public function setInputStreamList(array $inputStreamList)
    {
        $streamList = [];
        foreach ($inputStreamList as $eStream) {
            if (is_array($eStream) && !empty($eStream)) {
                $streamList[] = $eStream;
            }
        }
        if (empty($streamList)) {
            throw new TencentException('输入流列表不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        $this->reqData['InputStreamList'] = $streamList;
    }

    /**
     * @param array $outputParams
     *
     * @throws \SyException\Live\TencentException
     */
    public function setOutputParams(array $outputParams)
    {
        if (empty($outputParams)) {
            throw new TencentException('输出流参数不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        $this->reqData['OutputParams'] = $outputParams;
    }

    /**
     * @param int $mixStreamTemplateId
     *
     * @throws \SyException\Live\TencentException
     */
    public function setMixStreamTemplateId(int $mixStreamTemplateId)
    {
        if ($mixStreamTemplateId >= 0) {
            $this->reqData['MixStreamTemplateId'] = $mixStreamTemplateId;
        } else {
            throw new TencentException('输入模板ID不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param array $controlParams
     *
     * @throws \SyException\Live\TencentException
     */
    public function setControlParams(array $controlParams)
    {
        if (empty($controlParams)) {
            throw new TencentException('特殊控制参数不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        $this->reqData['ControlParams'] = $controlParams;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['MixStreamSessionId'])) {
            throw new TencentException('会话ID不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        if (!isset($this->reqData['InputStreamList'])) {
            throw new TencentException('输入流列表不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        if (!isset($this->reqData['OutputParams'])) {
            throw new TencentException('输出流参数不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
