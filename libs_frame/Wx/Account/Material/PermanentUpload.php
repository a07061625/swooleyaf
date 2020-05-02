<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/13 0013
 * Time: 9:37
 */
namespace Wx\Account\Material;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilAccount;
use Wx\WxUtilBase;

class PermanentUpload extends WxBaseAccount
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 文件信息
     * @var string
     */
    private $file_info = '';
    /**
     * 文件全路径,包括文件名
     * @var string
     */
    private $file_path = '';

    public function __construct(string $appId, string $type)
    {
        parent::__construct();
        if (!isset(self::$totalMaterialType[$type])) {
            throw new WxException('类型不支持', ErrorCode::WX_PARAM_ERROR);
        }

        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/material/add_material?type=' . $type . '&access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    /**
     * @param array $fileInfo
     * @throws \SyException\Wx\WxException
     */
    public function setFileInfo(array $fileInfo)
    {
        if (empty($fileInfo)) {
            throw new WxException('文件信息不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['description'] = Tool::jsonEncode($fileInfo, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param string $filePath
     * @throws \SyException\Wx\WxException
     */
    public function setFilePath(string $filePath)
    {
        if (file_exists($filePath) && is_readable($filePath)) {
            $this->reqData['media'] = new \CURLFile($filePath);
        } else {
            throw new WxException('文件不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['description'])) {
            throw new WxException('文件信息不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['media'])) {
            throw new WxException('文件不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAccount::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = $this->reqData;
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['media_id'])) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
