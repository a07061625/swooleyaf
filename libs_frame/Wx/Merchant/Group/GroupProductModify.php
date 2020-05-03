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

class GroupProductModify extends WxBaseMerchant
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
    /**
     * 商品列表
     * @var array
     */
    private $product = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/merchant/group/productmod?access_token=';
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

    /**
     * @param array $productList
     */
    public function setProduct(array $productList)
    {
        foreach ($productList as $eProductInfo) {
            if (isset($eProductInfo['product_id']) && is_string($eProductInfo['product_id']) && (strlen($eProductInfo['product_id']) > 0)
               && isset($eProductInfo['mod_action']) && in_array($eProductInfo['mod_action'], [0, 1], true)) {
                $this->product[$eProductInfo['product_id']] = [
                    'product_id' => $eProductInfo['product_id'],
                    'mod_action' => $eProductInfo['mod_action'],
                ];
            }
        }
    }

    /**
     * @param array $productInfo
     * @throws \SyException\Wx\WxException
     */
    public function addProduct(array $productInfo)
    {
        if (isset($productInfo['product_id']) && is_string($productInfo['product_id']) && (strlen($productInfo['product_id']) > 0)
           && isset($productInfo['mod_action']) && in_array($productInfo['mod_action'], [0, 1], true)) {
            $this->product[$productInfo['product_id']] = [
                'product_id' => $productInfo['product_id'],
                'mod_action' => $productInfo['mod_action'],
            ];
        } else {
            throw new WxException('商品信息不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['group_id'])) {
            throw new WxException('分组ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (empty($this->product)) {
            throw new WxException('商品列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['product'] = array_values($this->product);

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilMerchant::getAccessToken($this->appid);
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
