<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/14 0014
 * Time: 16:01
 */
namespace Wx\Merchant\Product;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMerchant;
use Wx\WxUtilBase;
use Wx\WxUtilMerchant;

class ProductStatusModify extends WxBaseMerchant
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
     * 商品上下架状态(0-下架 1-上架)
     * @var int
     */
    private $status = 0;

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/merchant/modproductstatus?access_token=';
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
     * @param int $status
     * @throws \SyException\Wx\WxException
     */
    public function setStatus(int $status)
    {
        if (in_array($status, [0, 1], true)) {
            $this->reqData['status'] = $status;
        } else {
            throw new WxException('上下架状态不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['product_id'])) {
            throw new WxException('商品ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['status'])) {
            throw new WxException('上下架状态不能为空', ErrorCode::WX_PARAM_ERROR);
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
