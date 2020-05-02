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

class BatchGet extends WxBaseAccount
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 素材类型
     * @var string
     */
    private $type = '';
    /**
     * 偏移位置
     * @var int
     */
    private $offset = 0;
    /**
     * 条数
     * @var int
     */
    private $count = 0;

    public function __construct(string $appId)
    {
        parent::__construct();

        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=';
        $this->appid = $appId;
        $this->reqData['offset'] = 0;
        $this->reqData['count'] = 20;
    }

    private function __clone()
    {
    }

    /**
     * @param string $type
     * @throws \SyException\Wx\WxException
     */
    public function setType(string $type)
    {
        if (isset(self::$totalMaterialType[$type])) {
            $this->reqData['type'] = $type;
        } else {
            throw new WxException('素材类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $offset
     * @throws \SyException\Wx\WxException
     */
    public function setOffset(int $offset)
    {
        if ($offset >= 0) {
            $this->reqData['offset'] = $offset;
        } else {
            throw new WxException('偏移位置不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $count
     * @throws \SyException\Wx\WxException
     */
    public function setCount(int $count)
    {
        if (($count > 0) && ($count <= 20)) {
            $this->reqData['count'] = $count;
        } else {
            throw new WxException('条数不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['type'])) {
            throw new WxException('素材类型不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAccount::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['errcode'])) {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        } else {
            $resArr['data'] = $sendData;
        }

        return $resArr;
    }
}
