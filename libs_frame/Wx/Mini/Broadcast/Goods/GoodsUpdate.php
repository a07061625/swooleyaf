<?php
/**
 * 更新商品信息,审核通过的商品仅允许更新价格类型与价格,审核中的商品不允许更新,未审核的商品允许更新所有字段,只传入需要更新的字段
 * User: 姜伟
 * Date: 2020/6/21 0021
 * Time: 10:57
 */
namespace Wx\Mini\Broadcast\Goods;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;
use SyTool\Tool;
use Wx\WxBaseMini;
use Wx\WxUtilAlone;
use Wx\WxUtilBase;

/**
 * Class GoodsUpdate
 * @package Wx\Mini\Broadcast\Goods
 */
class GoodsUpdate extends WxBaseMini
{
    /**
     * 应用ID
     * @var string
     */
    private $appId = '';
    /**
     * 商品ID
     * @var int
     */
    private $goodsId = 0;
    /**
     * 商品图片
     * @var string
     */
    private $coverImgUrl = '';
    /**
     * 商品名称
     * @var string
     */
    private $name = '';
    /**
     * 价格类型 1：一口价(只需要传入price,price2不传) 2：价格区间(price字段为左边界，price2字段为右边界,price和price2必传) 3：显示折扣价(price字段为原价，price2字段为现价,price和price2必传)
     * @var int
     */
    private $priceType = 0;
    /**
     * 价格1,单位为分
     * @var int
     */
    private $price = 0;
    /**
     * 价格2,单位为分
     * @var int
     */
    private $price2 = 0;
    /**
     * 商品详情页的小程序路径
     * @var string
     */
    private $url = '';

    public function __construct(string $appId)
    {
        parent::__construct();
        $this->serviceUrl = 'https://api.weixin.qq.com/wxaapi/broadcast/goods/update?access_token=';
        $this->appId = $appId;
        $this->reqData = [
            'goodsInfo' => []
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param int $goodsId
     * @throws \SyException\Wx\WxException
     */
    public function setGoodsId(int $goodsId)
    {
        if ($goodsId > 0) {
            $this->reqData['goodsInfo']['goodsId'] = $goodsId;
        } else {
            throw new WxException('商品ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param string $coverImgUrl
     * @throws \SyException\Wx\WxException
     */
    public function setCoverImgUrl(string $coverImgUrl)
    {
        if (strlen($coverImgUrl) > 0) {
            $this->reqData['goodsInfo']['coverImgUrl'] = $coverImgUrl;
        } else {
            throw new WxException('商品图片不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @param int $priceType
     * @param int $price1
     * @param int $price2
     * @throws \SyException\Wx\WxException
     */
    public function setPrice(int $priceType, int $price1, int $price2 = -1)
    {
        switch ($priceType) {
            case 1:
                if ($price1 < 0) {
                    throw new WxException('价格不合法', ErrorCode::WX_PARAM_ERROR);
                }
                $this->reqData['goodsInfo']['price'] = bcdiv($price1, 100, 2);
                $this->reqData['goodsInfo']['price2'] = '';
                break;
            case 2:
                if ($price1 < 0) {
                    throw new WxException('最低价格不合法', ErrorCode::WX_PARAM_ERROR);
                }
                if ($price2 < 0) {
                    throw new WxException('最高价格不合法', ErrorCode::WX_PARAM_ERROR);
                }
                if ($price1 > $price2) {
                    throw new WxException('最低价格不能大于最高价格', ErrorCode::WX_PARAM_ERROR);
                }
                $this->reqData['goodsInfo']['price'] = bcdiv($price1, 100, 2);
                $this->reqData['goodsInfo']['price2'] = bcdiv($price2, 100, 2);
                break;
            case 3:
                if ($price1 < 0) {
                    throw new WxException('原价不合法', ErrorCode::WX_PARAM_ERROR);
                }
                if ($price2 < 0) {
                    throw new WxException('折扣价不合法', ErrorCode::WX_PARAM_ERROR);
                }
                if ($price1 < $price2) {
                    throw new WxException('原价不能小于折扣价', ErrorCode::WX_PARAM_ERROR);
                }
                $this->reqData['goodsInfo']['price'] = bcdiv($price1, 100, 2);
                $this->reqData['goodsInfo']['price2'] = bcdiv($price2, 100, 2);
                break;
            default:
                throw new WxException('价格类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['goodsInfo']['priceType'] = $priceType;
    }

    /**
     * @param string $name
     * @throws \SyException\Wx\WxException
     */
    public function setName(string $name)
    {
        $nameLength = strlen($name);
        if($nameLength <= 0){
            throw new WxException('商品名称不能为空', ErrorCode::WX_PARAM_ERROR);
        } elseif ($nameLength > 28) {
            throw new WxException('商品名称不合法', ErrorCode::WX_PARAM_ERROR);
        }

        $this->reqData['goodsInfo']['name'] = $name;
    }

    /**
     * @param string $url
     * @throws \SyException\Wx\WxException
     */
    public function setUrl(string $url)
    {
        if (strlen($url) > 0) {
            $this->reqData['goodsInfo']['url'] = urlencode($url);
        } else {
            throw new WxException('商品详情页路径不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @return array
     * @throws \SyException\Wx\WxException
     */
    public function getDetail() : array
    {
        if (!isset($this->reqData['goodsInfo']['goodsId'])) {
            throw new WxException('商品ID不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (count($this->reqData['goodsInfo']) == 1) {
            throw new WxException('商品信息不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        $resArr = [
            'code' => 0
        ];

        $this->curlConfigs[CURLOPT_URL] = $this->serviceUrl . WxUtilAlone::getAccessToken($this->appId);
        $this->curlConfigs[CURLOPT_POSTFIELDS] = Tool::jsonEncode($this->reqData, JSON_UNESCAPED_UNICODE);
        $this->curlConfigs[CURLOPT_SSL_VERIFYPEER] = false;
        $this->curlConfigs[CURLOPT_SSL_VERIFYHOST] = false;
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
