<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-11
 * Time: 下午5:12
 */
namespace DingDing\Corp\File;

use SyConstant\ErrorCode;
use DesignPatterns\Singletons\DingTalkConfigSingleton;
use DingDing\TalkBaseCorp;
use DingDing\TalkTraitCorp;
use SyException\DingDing\TalkException;

/**
 * 单步文件上传
 * @package DingDing\Corp\File
 */
class UploadSingle extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 应用ID
     * @var string
     */
    private $agent_id = '';
    /**
     * 文件大小
     * @var int
     */
    private $file_size = 0;

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
        $agentInfo = DingTalkConfigSingleton::getInstance()->getCorpConfig($corpId)->getAgentInfo($agentTag);
        $this->agent_id = $agentInfo['id'];
    }

    private function __clone()
    {
    }

    /**
     * @param string $filePath
     * @throws \SyException\DingDing\TalkException
     */
    public function setFilePath(string $filePath)
    {
        if (file_exists($filePath) && is_readable($filePath)) {
            $this->reqData['file'] = new \CURLFile($filePath);
            $this->file_size = filesize($filePath);
        } else {
            throw new TalkException('文件不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['file'])) {
            throw new TalkException('文件不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/file/upload/single?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
            'agent_id' => $this->agent_id,
            'file_size' => $this->file_size,
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $this->reqData;
        return $this->sendRequest('POST');
    }
}
