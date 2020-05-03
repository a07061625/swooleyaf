<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/14 0014
 * Time: 16:01
 */
namespace Wx\Merchant\Group;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMerchant;
use Wx\WxUtilBase;
use Wx\WxUtilMerchant;

class GroupAdd extends WxBaseMerchant
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 分组名称
     * @var string
     */
    private $group_name = '';
    /**
     * 商品ID列表
     * @var array
     */
    private $product_list = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/merchant/group/add?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    /**
     * @param string $groupName
     * @throws \SyException\Wx\WxException
     */
    public function setGroupName(string $groupName)
    {
        if (strlen($groupName) > 0) {
            $this->reqData['group_name'] = $groupName;
        } else {
            throw new WxException('分组名称不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param array $productList
     */
    public function setProductList(array $productList)
    {
        foreach ($productList as $eProductId) {
            if (is_string($eProductId) && (strlen($eProductId) > 0)) {
                $this->product_list[$eProductId] = 1;
            }
        }
    }

    /**
     * @param string $productId
     * @throws \SyException\Wx\WxException
     */
    public function addProduct(string $productId)
    {
        if (strlen($productId) > 0) {
            $this->product_list[$productId] = 1;
        } else {
            throw new WxException('商品ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['group_name'])) {
            throw new WxException('分组名称不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (empty($this->product_list)) {
            throw new WxException('商品ID列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['product_list'] = array_keys($this->product_list);

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilMerchant::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode([
            'group_detail' => $this->reqData,
        ], JSON_UNESCAPED_UNICODE);
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
