<?php
/**
 * 修改头像
 * User: 姜伟
 * Date: 2018/9/13 0013
 * Time: 7:34
 */
namespace Wx\OpenMini\Base;

use SyConstant\ErrorCode;
use SyException\Wx\WxOpenException;
use SyTool\Tool;
use Wx\WxBaseOpenMini;
use Wx\WxUtilBase;
use Wx\WxUtilOpenBase;

class AccountHeadImageModify extends WxBaseOpenMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 头像素材
     * @var string
     */
    private $head_img_media_id = '';
    /**
     * 起始点横坐标
     * @var float
     */
    private $x1 = 0.00;
    /**
     * 起始点纵坐标
     * @var float
     */
    private $y1 = 0.00;
    /**
     * 截止点横坐标
     * @var float
     */
    private $x2 = 0.00;
    /**
     * 截止点纵坐标
     * @var float
     */
    private $y2 = 0.00;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/account/modifyheadimage?access_token=';
        $this->appId = $appId;
    }

    public function __clone()
    {
    }

    /**
     * @param string $headImage
     * @throws \SyException\Wx\WxOpenException
     */
    public function setHeadImgMediaId(string $headImage)
    {
        if (strlen($headImage) > 0) {
            $this->reqData['head_img_media_id'] = $headImage;
        } else {
            throw new WxOpenException('头像素材不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @param float $x1
     * @throws \SyException\Wx\WxOpenException
     */
    public function setX1(float $x1)
    {
        if ((bccomp($x1, 0) >= 0) && (bccomp($x1, 1) <= 0)) {
            $this->reqData['x1'] = $x1;
        } else {
            throw new WxOpenException('起始点横坐标不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @param float $y1
     * @throws \SyException\Wx\WxOpenException
     */
    public function setY1(float $y1)
    {
        if ((bccomp($y1, 0) >= 0) && (bccomp($y1, 1) <= 0)) {
            $this->reqData['y1'] = $y1;
        } else {
            throw new WxOpenException('起始点纵坐标不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @param float $x2
     * @throws \SyException\Wx\WxOpenException
     */
    public function setX2(float $x2)
    {
        if ((bccomp($x2, 0) >= 0) && (bccomp($x2, 1) <= 0)) {
            $this->reqData['x2'] = $x2;
        } else {
            throw new WxOpenException('截止点横坐标不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    /**
     * @param float $y2
     * @throws \SyException\Wx\WxOpenException
     */
    public function setY2(float $y2)
    {
        if ((bccomp($y2, 0) >= 0) && (bccomp($y2, 1) <= 0)) {
            $this->reqData['y2'] = $y2;
        } else {
            throw new WxOpenException('截止点纵坐标不合法', ErrorCode::WXOPEN_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['head_img_media_id'])) {
            throw new WxOpenException('头像素材不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        if (!isset($this->reqData['x1'])) {
            throw new WxOpenException('起始点横坐标不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        if (!isset($this->reqData['y1'])) {
            throw new WxOpenException('起始点纵坐标不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        if (!isset($this->reqData['x2'])) {
            throw new WxOpenException('截止点横坐标不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }
        if (!isset($this->reqData['y2'])) {
            throw new WxOpenException('截止点纵坐标modifysignature不能为空', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilOpenBase::getAuthorizerAccessToken($this->appId);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WXOPEN_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
