<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 17:21
 */
namespace Wx\Mini;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMini;
use Wx\WxUtilBase;
use Wx\WxUtilAlone;

class Qrcode extends WxBaseMini
{
    /**
     * 应用ID
     * @var string
     */
    private $app_id = '';
    /**
     * 场景
     * @var string
     */
    private $scene = '';
    /**
     * 页面地址
     * @var string
     */
    private $page = '';
    /**
     * 二维码宽度
     * @var int
     */
    private $width = 0;
    /**
     * 线条颜色配置
     * @var bool
     */
    private $auto_color = false;
    /**
     * 线条rgb颜色
     * @var array
     */
    private $line_color = [];
    /**
     * 透明底色标识
     * @var bool
     */
    private $is_hyaline = false;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token=';
        $this->app_id = $appId;
        $this->reqData['width'] = 430;
        $this->reqData['auto_color'] = false;
        $this->reqData['line_color'] = [
            'r' => '0',
            'g' => '0',
            'b' => '0',
        ];
        $this->reqData['is_hyaline'] = false;
    }

    public function __clone()
    {
    }

    /**
     * @param string $scene
     * @throws \SyException\Wx\WxException
     */
    public function setScene(string $scene)
    {
        $trueScene = trim($scene);
        $length = strlen($trueScene);
        if ($length == 0) {
            throw new WxException('场景标识不能为空', ErrorCode::WX_PARAM_ERROR);
        } elseif ($length > 32) {
            throw new WxException('场景标识不能超过32个字符', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['scene'] = $trueScene;
    }

    /**
     * @param string $page
     * @throws \SyException\Wx\WxException
     */
    public function setPage(string $page)
    {
        $truePage = trim($page);
        if (strlen($truePage) > 0) {
            $this->reqData['page'] = $truePage;
        } else {
            throw new WxException('页面地址不能为空', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $width
     * @throws \SyException\Wx\WxException
     */
    public function setWidth(int $width)
    {
        if ($width > 0) {
            $this->reqData['width'] = $width;
        } else {
            throw new WxException('二维码宽度必须大于0', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param bool $autoColor
     */
    public function setAutoColor(bool $autoColor)
    {
        $this->reqData['auto_color'] = $autoColor;
    }

    /**
     * @param int $red
     * @param int $green
     * @param int $blue
     * @throws \SyException\Wx\WxException
     */
    public function setLineColor(int $red, int $green, int $blue)
    {
        if (($red < 0) || ($red > 255)) {
            throw new WxException('线条颜色red不合法', ErrorCode::WX_PARAM_ERROR);
        } elseif (($green < 0) || ($green > 255)) {
            throw new WxException('线条颜色green不合法', ErrorCode::WX_PARAM_ERROR);
        } elseif (($blue < 0) || ($blue > 255)) {
            throw new WxException('线条颜色blue不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['line_color'] = [
            'r' => (string)$red,
            'g' => (string)$green,
            'b' => (string)$blue,
        ];
    }

    /**
     * @param bool $isHyaline true:需要透明底色 false:不需要透明底色
     */
    public function setIsHyaline(bool $isHyaline)
    {
        $this->reqData['is_hyaline'] = $isHyaline;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['scene'])) {
            throw new WxException('场景标识必须填写', ErrorCode::WX_PARAM_ERROR);
        } elseif (!isset($this->reqData['page'])) {
            throw new WxException('页面地址必须填写', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAlone::getAccessToken($this->app_id);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (is_array($sendData)) {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        } else {
            $resArr['data'] = [
                'image' => base64_encode($sendRes),
            ];
        }

        return $resArr;
    }
}
