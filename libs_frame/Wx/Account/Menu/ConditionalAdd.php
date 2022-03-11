<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 15:43
 */

namespace Wx\Account\Menu;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseAccount;
use Wx\WxUtilAlone;
use Wx\WxUtilBase;

class ConditionalAdd extends WxBaseAccount
{
    /**
     * 公众号ID
     *
     * @var string
     */
    private $appid = '';
    /**
     * 一级菜单列表
     *
     * @var array
     */
    private $button = [];
    /**
     * 菜单匹配规则
     *
     * @var array
     */
    private $matchrule = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=';
        $this->appid = $appId;
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function addButton(array $button)
    {
        if (\count($this->button) >= 3) {
            throw new WxException('菜单数量不能超过3个', ErrorCode::WX_PARAM_ERROR);
        }

        $this->button[] = $button;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setMatchRule(array $matchRule)
    {
        if (empty($matchRule)) {
            throw new WxException('菜单匹配规则不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['matchrule'] = $matchRule;
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['matchrule'])) {
            throw new WxException('菜单匹配规则不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (empty($this->button)) {
            throw new WxException('菜单不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['button'] = $this->button;

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAlone::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (isset($sendData['menuid'])) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
