<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/14 0014
 * Time: 16:01
 */
namespace Wx\Merchant\Stock;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMerchant;
use Wx\WxUtilBase;
use Wx\WxUtilMerchant;

class StockReduce extends WxBaseMerchant
{
    /**
     * 公众号ID
     * @var string
     */
    private $appid = '';
    /**
     * 商品ID
     * @var string
     */
    private $product_id = '';
    /**
     * sku信息,格式"id1:vid1;id2:vid2"
     * @var string
     */
    private $sku_info = '';
    /**
     * 减少的库存数量
     * @var int
     */
    private $quantity = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/merchant/stock/reduce?access_token=';
        $this->appid = $appId;
    }

    private function __clone()
    {
    }

    /**
     * @param string $productId
     * @throws \SyException\Wx\WxException
     */
    public function setProductId(string $productId)
    {
        if (strlen($productId) > 0) {
            $this->reqData['product_id'] = $productId;
        } else {
            throw new WxException('商品ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $skuInfo
     * @throws \SyException\Wx\WxException
     */
    public function setSkuInfo(string $skuInfo)
    {
        if (strlen($skuInfo) > 0) {
            $this->reqData['sku_info'] = $skuInfo;
        } else {
            throw new WxException('sku信息不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $quantity
     * @throws \SyException\Wx\WxException
     */
    public function setQuantity(int $quantity)
    {
        if ($quantity > 0) {
            $this->reqData['quantity'] = $quantity;
        } else {
            throw new WxException('库存数量不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['product_id'])) {
            throw new WxException('商品ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['sku_info'])) {
            throw new WxException('sku信息不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['quantity'])) {
            throw new WxException('库存数量不能为空', ErrorCode::WX_PARAM_ERROR);
        }

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
