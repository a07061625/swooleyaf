<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/12/14 0014
 * Time: 16:01
 */

namespace Wx\Merchant\Product;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMerchant;
use Wx\WxUtilBase;
use Wx\WxUtilMerchant;

class ProductCreate extends WxBaseMerchant
{
    /**
     * 公众号ID
     *
     * @var string
     */
    private $appid = '';
    /**
     * 商品名称
     *
     * @var string
     */
    private $name = '';
    /**
     * 商品分类id
     *
     * @var array
     */
    private $category_id = [];
    /**
     * 商品主图
     *
     * @var string
     */
    private $main_img = '';
    /**
     * 商品图片列表
     *
     * @var array
     */
    private $img = [];
    /**
     * 商品详情列表
     *
     * @var array
     */
    private $detail = [];
    /**
     * 商品属性列表
     *
     * @var array
     */
    private $property = [];
    /**
     * 商品sku信息
     *
     * @var array
     */
    private $sku_info = [];
    /**
     * 商品限购数量
     *
     * @var int
     */
    private $buy_limit = 0;
    /**
     * 商品sku信息列表
     *
     * @var array
     */
    private $sku_list = [];
    /**
     * 商品其他属性
     *
     * @var array
     */
    private $attrext = [];
    /**
     * 运费信息
     *
     * @var array
     */
    private $delivery_info = [];

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/merchant/create?access_token=';
        $this->appid = $appId;
        $this->reqData['product_base'] = [];
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setName(string $name)
    {
        if (\strlen($name) > 0) {
            $this->reqData['product_base']['name'] = $name;
        } else {
            throw new WxException('商品名称不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setCategoryId(array $categoryIdList)
    {
        foreach ($categoryIdList as $eCategoryId) {
            if (\is_int($eCategoryId) && ($eCategoryId > 0)) {
                $this->category_id[$eCategoryId] = 1;
            }
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function addCategoryId(int $categoryId)
    {
        if ($categoryId > 0) {
            $this->category_id[$categoryId] = 1;
        } else {
            throw new WxException('商品分类ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setMainImg(string $mainImg)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $mainImg) > 0) {
            $this->reqData['product_base']['main_img'] = $mainImg;
        } else {
            throw new WxException('商品主图不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setImg(array $imgList)
    {
        foreach ($imgList as $eImage) {
            if (\is_string($eImage) && (preg_match(ProjectBase::REGEX_URL_HTTP, $eImage) > 0)) {
                $this->img[] = $eImage;
            }
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function addImg(string $img)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $img) > 0) {
            $this->img[] = $img;
        } else {
            throw new WxException('商品图片不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setDetail(array $detailList)
    {
        foreach ($detailList as $eDetail) {
            if (\is_array($eDetail) && (!empty($eDetail))) {
                $this->detail[] = $eDetail;
            }
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function addDetail(array $detailInfo)
    {
        if (empty($detailInfo)) {
            throw new WxException('商品详情信息不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->detail[] = $detailInfo;
    }

    public function setProperty(array $propertyList)
    {
        foreach ($propertyList as $eProperty) {
            if (\is_array($eProperty) && (!empty($eProperty))) {
                $this->property[] = $eProperty;
            }
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function addProperty(array $propertyInfo)
    {
        if (empty($propertyInfo)) {
            throw new WxException('商品属性信息不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->property[] = $propertyInfo;
    }

    public function setSkuInfo(array $skuInfoList)
    {
        foreach ($skuInfoList as $eSkuInfo) {
            if (\is_array($eSkuInfo) && (!empty($eSkuInfo))) {
                $this->sku_info[] = $eSkuInfo;
            }
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function addSkuInfo(array $skuInfo)
    {
        if (empty($skuInfo)) {
            throw new WxException('商品sku信息不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->sku_info[] = $skuInfo;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setBuyLimit(int $buyLimit)
    {
        if ($buyLimit > 0) {
            $this->reqData['product_base']['buy_limit'] = $buyLimit;
        } else {
            throw new WxException('商品限购数量不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setSkuList(array $skuList)
    {
        foreach ($skuList as $eSku) {
            if (\is_array($eSku) && (!empty($eSku))) {
                $this->sku_list[] = $eSku;
            }
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function addSkuList(array $sku)
    {
        if (empty($sku)) {
            throw new WxException('商品sku不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->sku_list[] = $sku;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setAttrext(array $attrext)
    {
        if (empty($attrext)) {
            throw new WxException('商品其他属性不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['attrext'] = $attrext;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setDeliveryInfo(array $deliveryInfo)
    {
        if (empty($deliveryInfo)) {
            throw new WxException('商品运费信息不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['delivery_info'] = $deliveryInfo;
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['product_base']['name'])) {
            throw new WxException('商品名称不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (empty($this->category_id)) {
            throw new WxException('商品分类ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['product_base']['category_id'] = array_keys($this->category_id);
        if (!isset($this->reqData['product_base']['main_img'])) {
            throw new WxException('商品主图不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (empty($this->img)) {
            throw new WxException('商品图片列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['product_base']['img'] = $this->img;
        if (empty($this->detail)) {
            throw new WxException('商品详情列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['product_base']['detail'] = $this->detail;
        if (empty($this->sku_list)) {
            throw new WxException('商品sku列表不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['delivery_info'])) {
            throw new WxException('商品运费信息不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sku_list'] = $this->sku_list;
        if (!empty($this->property)) {
            $this->reqData['product_base']['property'] = $this->property;
        }
        if (!empty($this->sku_info)) {
            $this->reqData['product_base']['sku_info'] = $this->sku_info;
        }

        $resArr = [
            'code' => 0,
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilMerchant::getAccessToken($this->appid);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $sendRes = WxUtilBase::sendPostReq($this->curlConfigs);
        $sendData = Tool::jsonDecode($sendRes);
        if (0 == $sendData['errcode']) {
            $resArr['data'] = $sendData;
        } else {
            $resArr['code'] = ErrorCode::WX_POST_ERROR;
            $resArr['message'] = $sendData['errmsg'];
        }

        return $resArr;
    }
}
