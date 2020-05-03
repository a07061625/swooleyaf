<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 15:59
 */
namespace Wx\Account\Menu;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilBase;
use Wx\WxUtilAlone;

class MenuCreate extends WxBaseAccount
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 菜单列表
     * @var array
     */
    private $menuList = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=';
        $this->appid = $appId;
    }

    public function __clone()
    {
    }

    /**
     * @param \Wx\Account\Menu\Menu $menu
     * @throws \SyException\Wx\WxException
     */
    public function addMenu(Menu $menu)
    {
        if (count($this->menuList) >= 3) {
            throw new WxException('菜单数量不能超过3个', ErrorCode::WX_PARAM_ERROR);
        }

        $this->menuList[] = $menu;
    }

    public function getDetail() : array
    {
        if (empty($this->menuList)) {
            throw new WxException('菜单列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0
        ];

        $this->reqData['button'] = [];
        foreach ($this->menuList as $eMenu) {
            $this->reqData['button'][] = $eMenu->getDetail();
        }

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAlone::getAccessToken($this->appid);
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
