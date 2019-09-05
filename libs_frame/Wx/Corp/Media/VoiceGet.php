<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/13 0013
 * Time: 9:37
 */
namespace Wx\Corp\Media;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseCorp;
use Wx\WxTraitCorp;
use Wx\WxUtilBase;

/**
 * 获取高清语音素材
 * @package Wx\Corp\Media
 */
class VoiceGet extends WxBaseCorp
{
    use WxTraitCorp;

    /**
     * 输出目录
     * @var string
     */
    private $output_dir = '';
    /**
     * 媒体文件ID
     * @var string
     */
    private $media_id = '';

    public function __construct(string $corpId, string $agentTag)
    {
        parent::__construct();
        $this->serviceUrl = 'https://qyapi.weixin.qq.com/cgi-bin/media/get/jssdkt';
        $this->_corpId = $corpId;
        $this->_agentTag = $agentTag;
    }

    private function __clone()
    {
    }

    /**
     * @param string $outputDir
     * @throws \SyException\Wx\WxException
     */
    public function setOutputDir(string $outputDir)
    {
        if (is_dir($outputDir) && is_writeable($outputDir)) {
            $this->output_dir = substr($outputDir, -1) == '/' ? $outputDir : $outputDir . '/';
        } else {
            throw new WxException('输出目录不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $mediaId
     * @throws \SyException\Wx\WxException
     */
    public function setMediaId(string $mediaId)
    {
        if (strlen($mediaId) > 0) {
            $this->reqData['media_id'] = $mediaId;
        } else {
            throw new WxException('媒体文件ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (strlen($this->output_dir) == 0) {
            throw new WxException('输出目录不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['media_id'])) {
            throw new WxException('媒体文件ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->reqData['access_token'] = $this->getAccessToken($this->_tokenType, $this->_corpId, $this->_agentTag);
        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . '?' . http_build_query($this->reqData);
        $this->curlConfigs[CURLOPT_TIMEOUT_MS] = 3000;
        $sendRes = WxUtilBase::sendGetReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (!is_array($sendData)) {
            $fileName = $this->output_dir . $this->reqData['media_id'];
            file_put_contents($fileName, $sendRes);
            $resArr['data'] = [
                'media_path' => $fileName,
            ];
        } elseif (isset($sendData['errcode'])) {
            $resArr['code'] = ErrorCode::WX_GET_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}
