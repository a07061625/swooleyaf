<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/14 0014
 * Time: 16:01
 */
namespace Wx\Shop\Merchant\Group;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use Tool\Tool;
use Wx\WxBaseShop;
use Wx\WxUtilBase;
use Wx\WxUtilShop;

class GroupDel extends WxBaseShop
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 分组ID
     * @var int
     */
    private $group_id = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/merchant/group/del?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    /**
     * @param int $groupId
     * @throws \SyException\Wx\WxException
     */
    public function setGroupId(int $groupId)
    {
        if ($groupId > 0) {
            $this->reqData['group_id'] = $groupId;
        } else {
            throw new WxException('分组ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['group_id'])) {
            throw new WxException('分组ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilShop::getAccessToken($this->appid);
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
