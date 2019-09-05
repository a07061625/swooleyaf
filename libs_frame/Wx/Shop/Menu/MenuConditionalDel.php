<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 15:43
 */
namespace Wx\Shop\Menu;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilBaseAlone;

class MenuConditionalDel extends WxBaseShop
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 菜单ID
     * @var string
     */
    private $menuid = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/menu/delconditional?access_token=';
        $this->appid = $appId;
    }

    public function __clone()
    {
    }

    /**
     * @param string $menuId
     * @throws \SyException\Wx\WxException
     */
    public function setMenuId(string $menuId)
    {
        if (strlen($menuId) > 0) {
            $this->reqData['menuid'] = $menuId;
        } else {
            throw new WxException('菜单ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['menuid'])) {
            throw new WxException('菜单ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilBaseAlone::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if ($sendData['errcode'] == 0) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
