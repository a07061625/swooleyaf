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
 * 上传文件块
 * @package DingDing\Corp\File
 */
class UploadChunk extends TalkBaseCorp
{
    use TalkTraitCorp;

    /**
     * 应用ID
     * @var string
     */
    private $agent_id = '';
    /**
     * 上传事务id
     * @var string
     */
    private $upload_id = '';
    /**
     * 文件块号
     * @var int
     */
    private $chunk_sequence = 0;

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
        } else {
            throw new TalkException('文件不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param string $uploadId
     * @throws \SyException\DingDing\TalkException
     */
    public function setUploadId(string $uploadId)
    {
        if (strlen($uploadId) > 0) {
            $this->upload_id = $uploadId;
        } else {
            throw new TalkException('上传事务id不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    /**
     * @param int $chunkSequence
     * @throws \SyException\DingDing\TalkException
     */
    public function setChunkSequence(int $chunkSequence)
    {
        if ($chunkSequence > 0) {
            $this->chunk_sequence = $chunkSequence;
        } else {
            throw new TalkException('文件块号不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['file'])) {
            throw new TalkException('文件不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if (strlen($this->upload_id) == 0) {
            throw new TalkException('上传事务id不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }
        if ($this->chunk_sequence <= 0) {
            throw new TalkException('文件块号不能为空', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceDomain . '/file/upload/chunk?' . http_build_query([
            'access_token' => $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag),
            'agent_id' => $this->agent_id,
            'upload_id' => $this->upload_id,
            'chunk_sequence' => $this->chunk_sequence,
        ]);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $this->reqData;
        return $this->sendRequest('POST');
    }
}
