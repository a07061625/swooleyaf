<?php
/**
 * 搜索物料
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;
use SyPromotion\TBK\Traits\SetDeviceEncryptTrait;
use SyPromotion\TBK\Traits\SetDeviceTypeTrait;
use SyPromotion\TBK\Traits\SetDeviceValueTrait;
use SyPromotion\TBK\Traits\SetMaterialIdTrait;
use SyPromotion\TBK\Traits\SetPageNo2Trait;
use SyPromotion\TBK\Traits\SetPageSizeTrait;
use SyPromotion\TBK\Traits\SetPlatformTrait;

/**
 * Class MaterialOptional
 *
 * @package SyPromotion\TBK\Promoter
 */
class MaterialOptional extends BaseTBK
{
    use SetPageSizeTrait;
    use SetPageNo2Trait;
    use SetPlatformTrait;
    use SetAdZoneIdTrait;
    use SetMaterialIdTrait;
    use SetDeviceValueTrait;
    use SetDeviceEncryptTrait;
    use SetDeviceTypeTrait;

    /**
     * 最低店铺dsr评分
     *
     * @var int
     */
    private $start_dsr = 0;
    /**
     * 页数
     *
     * @var int
     */
    private $page_no = 0;
    /**
     * 每页记录数
     *
     * @var int
     */
    private $page_size = 0;
    /**
     * 链接形式 1:PC 2:无线 默认１
     *
     * @var int
     */
    private $platform = 0;
    /**
     * 最高淘客佣金比率
     *
     * @var int
     */
    private $end_tk_rate = 0;
    /**
     * 最低淘客佣金比率
     *
     * @var int
     */
    private $start_tk_rate = 0;
    /**
     * 最高折扣价
     *
     * @var float
     */
    private $end_price = 0.0;
    /**
     * 最低折扣价
     *
     * @var float
     */
    private $start_price = 0.0;
    /**
     * 海外商品标识 true:海外商品 false:不限
     *
     * @var bool
     */
    private $is_overseas = false;
    /**
     * 天猫商品标识 true:天猫商品 false:不限
     *
     * @var bool
     */
    private $is_tmall = false;
    /**
     * 排序
     *
     * @var string
     */
    private $sort = '';
    /**
     * 所在地
     *
     * @var string
     */
    private $itemloc = '';
    /**
     * 后台类目ID列表
     *
     * @var array
     */
    private $cat = [];
    /**
     * 查询关键词
     *
     * @var string
     */
    private $q = '';
    /**
     * 物料ID
     *
     * @var int
     */
    private $material_id = 0;
    /**
     * 优惠券标识 true:该商品有优惠券 false:不限
     *
     * @var bool
     */
    private $has_coupon = false;
    /**
     * IP地址
     *
     * @var string
     */
    private $ip = '';
    /**
     * 广告位ID
     *
     * @var int
     */
    private $adzone_id = 0;
    /**
     * 退款率低于行业均值标识 true:大于等于 false:不限
     *
     * @var bool
     */
    private $include_rfd_rate = false;
    /**
     * 好评率高于行业均值标识 true:大于等于 false:不限
     *
     * @var bool
     */
    private $include_good_rate = false;
    /**
     * 成交转化高于行业均值标识 true:大于等于 false:不限
     *
     * @var bool
     */
    private $include_pay_rate_30 = false;
    /**
     * 消费者保障标识 true:加入 false:不限
     *
     * @var bool
     */
    private $need_prepay = false;
    /**
     * 包邮标识 true:包邮 false:不限
     *
     * @var bool
     */
    private $need_free_shipment = false;
    /**
     * 牛皮癣程度 1:不限 2:无 3:轻微
     *
     * @var int
     */
    private $npx_level = 0;
    /**
     * 最高KA媒体淘客佣金率
     *
     * @var int
     */
    private $end_ka_tk_rate = 0;
    /**
     * 最低KA媒体淘客佣金率
     *
     * @var int
     */
    private $start_ka_tk_rate = 0;
    /**
     * 设备号加密值
     *
     * @var string
     */
    private $device_value = '';
    /**
     * 设备号加密类型
     *
     * @var string
     */
    private $device_encrypt = '';
    /**
     * 设备号类型
     *
     * @var string
     */
    private $device_type = '';
    /**
     * 锁佣结束时间
     *
     * @var int
     */
    private $lock_rate_end_time = 0;
    /**
     * 锁佣开始时间
     *
     * @var int
     */
    private $lock_rate_start_time = 0;
    /**
     * 纬度
     *
     * @var string
     */
    private $latitude = '';
    /**
     * 经度
     *
     * @var string
     */
    private $longitude = '';
    /**
     * 国标城市码
     *
     * @var string
     */
    private $city_code = '';
    /**
     * 商家ID列表
     *
     * @var array
     */
    private $seller_ids = [];
    /**
     * 会员运营ID
     *
     * @var string
     */
    private $special_id = '';
    /**
     * 渠道关系ID
     *
     * @var string
     */
    private $relation_id = '';
    /**
     * 分页标识
     *
     * @var string
     */
    private $page_result_key = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dg.material.optional');
        $this->reqData['page_no'] = 1;
        $this->reqData['page_size'] = 20;
        $this->reqData['platform'] = 1;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setStartDsr(int $startDsr)
    {
        if (($startDsr >= 0) && ($startDsr <= 50000)) {
            $this->reqData['start_dsr'] = $startDsr;
        } else {
            throw new TBKException('最低店铺dsr评分不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setEndTkRate(int $endTkRate)
    {
        if (($endTkRate >= 0) && ($endTkRate <= 10000)) {
            $this->reqData['end_tk_rate'] = $endTkRate;
        } else {
            throw new TBKException('最高淘客佣金比率不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setStartTkRate(int $startTkRate)
    {
        if (($startTkRate >= 0) && ($startTkRate <= 10000)) {
            $this->reqData['start_tk_rate'] = $startTkRate;
        } else {
            throw new TBKException('最低淘客佣金比率不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setEndPrice(float $endPrice)
    {
        if ($endPrice >= 0) {
            $this->reqData['end_price'] = (float)number_format($endPrice, 2, '.', '');
        } else {
            throw new TBKException('最高折扣价不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setStartPrice(float $startPrice)
    {
        if ($startPrice >= 0) {
            $this->reqData['start_price'] = (float)number_format($startPrice, 2, '.', '');
        } else {
            throw new TBKException('最低折扣价不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function setIsOverseas(bool $isOverseas)
    {
        $this->reqData['is_overseas'] = $isOverseas;
    }

    public function setIsTmall(bool $isTmall)
    {
        $this->reqData['is_tmall'] = $isTmall;
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSort(string $sortField, string $sortType)
    {
        if (!\in_array($sortField, ['total_sales', 'tk_rate', 'tk_total_sales', 'tk_total_commi', 'price'])) {
            throw new TBKException('排序字段不支持', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!\in_array($sortType, ['asc', 'des'])) {
            throw new TBKException('排序类型不支持', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['sort'] = $sortField . '_' . $sortType;
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setItemLoc(string $itemLoc)
    {
        if (\strlen($itemLoc) > 0) {
            $this->reqData['itemloc'] = $itemLoc;
        } else {
            throw new TBKException('所在地不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setCat(array $cats)
    {
        $catList = [];
        foreach ($cats as $eCat) {
            if (\is_int($eCat) && ($eCat > 0)) {
                $catList[$eCat] = 1;
            }
        }
        $catLength = \count($catList);
        if (0 == $catLength) {
            throw new TBKException('后台类目ID列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if ($catLength > 10) {
            throw new TBKException('后台类目ID列表不能超过10个', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['cat'] = implode(',', array_keys($catList));
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setKeyword(string $keyword)
    {
        if (\strlen($keyword) > 0) {
            $this->reqData['q'] = $keyword;
        } else {
            throw new TBKException('查询关键词不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function setHasCoupon(bool $hasCoupon)
    {
        $this->reqData['has_coupon'] = $hasCoupon;
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setIp(string $ip)
    {
        if (preg_match(ProjectBase::REGEX_IP, '.' . $ip) > 0) {
            $this->reqData['ip'] = $ip;
        } else {
            throw new TBKException('ip地址不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function setIncludeRfdRate(bool $includeRfdRate)
    {
        $this->reqData['include_rfd_rate'] = $includeRfdRate;
    }

    public function setIncludeGoodRate(bool $includeGoodRate)
    {
        $this->reqData['include_good_rate'] = $includeGoodRate;
    }

    public function setIncludePayRate30(bool $includePayRate30)
    {
        $this->reqData['include_pay_rate_30'] = $includePayRate30;
    }

    public function setNeedPrepay(bool $needPrepay)
    {
        $this->reqData['need_prepay'] = $needPrepay;
    }

    public function setNeedFreeShipment(bool $needFreeShipment)
    {
        $this->reqData['need_free_shipment'] = $needFreeShipment;
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setNpxLevel(int $npxLevel)
    {
        if (\in_array($npxLevel, [1, 2, 3])) {
            $this->reqData['npx_level'] = $npxLevel;
        } else {
            throw new TBKException('牛皮癣程度不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setEndKaTkRate(int $endKaTkRate)
    {
        if (($endKaTkRate >= 0) && ($endKaTkRate <= 10000)) {
            $this->reqData['end_ka_tk_rate'] = $endKaTkRate;
        } else {
            throw new TBKException('最高KA媒体淘客佣金率不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setStartKaTkRate(int $startKaTkRate)
    {
        if (($startKaTkRate >= 0) && ($startKaTkRate <= 10000)) {
            $this->reqData['start_ka_tk_rate'] = $startKaTkRate;
        } else {
            throw new TBKException('最低KA媒体淘客佣金率不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setLockRateEndTime(int $lockRateEndTime)
    {
        if ($lockRateEndTime > 1262275200) {
            $this->reqData['lock_rate_end_time'] = 1000 * $lockRateEndTime;
        } else {
            throw new TBKException('锁佣结束时间不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setLockRateStartTime(int $lockRateStartTime)
    {
        if ($lockRateStartTime > 1262275200) {
            $this->reqData['lock_rate_start_time'] = 1000 * $lockRateStartTime;
        } else {
            throw new TBKException('锁佣开始时间不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setLatitude(string $latitude)
    {
        if (is_numeric($latitude) && ($latitude >= -90) && ($latitude <= 90)) {
            $this->reqData['latitude'] = $latitude;
        } else {
            throw new TBKException('纬度不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setLongitude(string $longitude)
    {
        if (is_numeric($longitude) && ($longitude >= -180) && ($longitude <= 180)) {
            $this->reqData['longitude'] = $longitude;
        } else {
            throw new TBKException('经度不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setCityCode(string $cityCode)
    {
        if (ctype_digit($cityCode)) {
            $this->reqData['city_code'] = $cityCode;
        } else {
            throw new TBKException('国标城市码不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSellerIds(array $sellerIds)
    {
        $sellerIdList = [];
        foreach ($sellerIds as $eSellerId) {
            if (\is_int($eSellerId) && ($eSellerId > 0)) {
                $sellerIdList[$eSellerId] = 1;
            }
        }
        $sellerLength = \count($sellerIdList);
        if (0 == $sellerLength) {
            throw new TBKException('商家ID列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if ($sellerLength > 100) {
            throw new TBKException('商家ID列表不能超过100个', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['seller_ids'] = implode(',', array_keys($sellerIdList));
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRelationId(string $relationId)
    {
        if (\strlen($relationId) > 0) {
            $this->reqData['relation_id'] = $relationId;
        } else {
            throw new TBKException('渠道关系ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSpecialId(string $specialId)
    {
        if (\strlen($specialId) > 0) {
            $this->reqData['special_id'] = $specialId;
        } else {
            throw new TBKException('会员运营ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPageResultKey(string $pageResultKey)
    {
        if (\strlen($pageResultKey) > 0) {
            $this->reqData['page_result_key'] = $pageResultKey;
        } else {
            throw new TBKException('分页标识不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['adzone_id'])) {
            throw new TBKException('广告位ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
