<?php
/**
 * 创建门店信息
 * User: 姜伟
 * Date: 2018/11/2 0002
 * Time: 9:03
 */

namespace AliPay\Shop;

use AliPay\AliPayBase;
use DesignPatterns\Singletons\AliPayConfigSingleton;
use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\AliPay\AliPayShopException;

class ShopCreate extends AliPayBase
{
    /**
     * 门店编号
     *
     * @var string
     */
    private $store_id = '';
    /**
     * 类目id
     *
     * @var string
     */
    private $category_id = '';
    /**
     * 品牌名
     *
     * @var string
     */
    private $brand_name = '';
    /**
     * 品牌LOGO
     *
     * @var string
     */
    private $brand_logo = '';
    /**
     * 主门店名
     *
     * @var string
     */
    private $main_shop_name = '';
    /**
     * 分店名称
     *
     * @var string
     */
    private $branch_shop_name = '';
    /**
     * 省份编码
     *
     * @var string
     */
    private $province_code = '';
    /**
     * 城市编码
     *
     * @var string
     */
    private $city_code = '';
    /**
     * 区县编码
     *
     * @var string
     */
    private $district_code = '';
    /**
     * 详细地址
     *
     * @var string
     */
    private $address = '';
    /**
     * GCJ-02坐标系经度
     *
     * @var string
     */
    private $longitude = '';
    /**
     * GCJ-02坐标系纬度
     *
     * @var string
     */
    private $latitude = '';
    /**
     * 门店电话号码
     *
     * @var array
     */
    private $contact_number = [];
    /**
     * 店长电话号码
     *
     * @var string
     */
    private $notify_mobile = '';
    /**
     * 门店首图
     *
     * @var string
     */
    private $main_image = '';
    /**
     * 审核图片
     *
     * @var array
     */
    private $audit_images = [];
    /**
     * 营业时间
     *
     * @var string
     */
    private $business_time = '';
    /**
     * 支持WIFI状态 T:支持 F:不支持 空:客户端不展示
     *
     * @var string
     */
    private $wifi = '';
    /**
     * 支持停车状态 T:支持 F:不支持 空:客户端不展示
     *
     * @var string
     */
    private $parking = '';
    /**
     * 其他服务
     *
     * @var string
     */
    private $value_added = '';
    /**
     * 人均消费价格,最少1元
     *
     * @var int
     */
    private $avg_price = 0;
    /**
     * ISV返佣id
     *
     * @var string
     */
    private $isv_uid = '';
    /**
     * 营业执照图片
     *
     * @var string
     */
    private $licence = '';
    /**
     * 营业执照编号
     *
     * @var string
     */
    private $licence_code = '';
    /**
     * 营业执照名称
     *
     * @var string
     */
    private $licence_name = '';
    /**
     * 营业执照过期时间
     *
     * @var string
     */
    private $licence_expires = '';
    /**
     * 许可证
     *
     * @var string
     */
    private $business_certificate = '';
    /**
     * 许可证有效期
     *
     * @var string
     */
    private $business_certificate_expires = '';
    /**
     * 授权函
     *
     * @var string
     */
    private $auth_letter = '';
    /**
     * 其他平台开店状态 T:有开店 F:未开店
     *
     * @var string
     */
    private $is_operating_online = '';
    /**
     * 其他平台开店的店铺链接url
     *
     * @var array
     */
    private $online_url = [];
    /**
     * 审核状态消息推送地址
     *
     * @var string
     */
    private $operate_notify_url = '';
    /**
     * 机具号
     *
     * @var array
     */
    private $implement_id = [];
    /**
     * 无烟区状态 T:有无烟区 F:没有无烟区 空:客户端不展示
     *
     * @var string
     */
    private $no_smoking = '';
    /**
     * 包厢状态 T:有包厢 F:没有包厢 空:客户端不展示
     *
     * @var string
     */
    private $box = '';
    /**
     * 请求ID
     *
     * @var string
     */
    private $request_id = '';
    /**
     * 其他资质
     *
     * @var string
     */
    private $other_authorization = '';
    /**
     * 操作人角色
     *
     * @var string
     */
    private $op_role = '';
    /**
     * 业务版本号
     *
     * @var string
     */
    private $biz_version = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $payConfig = AliPayConfigSingleton::getInstance()->getPayConfig($appId);
        $this->notify_url = $payConfig->getUrlNotify();
        $this->biz_content['biz_version'] = '2.0';
        $this->setMethod('alipay.offline.market.shop.create');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setStoreId(string $storeId)
    {
        if (ctype_alnum($storeId) && (\strlen($storeId) <= 32)) {
            $this->biz_content['store_id'] = $storeId;
        } else {
            throw new AliPayShopException('门店编号不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setCategoryId(string $categoryId)
    {
        if (ctype_digit($categoryId) && (\strlen($categoryId) <= 32)) {
            $this->biz_content['category_id'] = $categoryId;
        } else {
            throw new AliPayShopException('类目id不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setBrandName(string $brandName)
    {
        $trueName = trim($brandName);
        $length = \strlen($trueName);
        if (($length > 0) && ($length <= 512)) {
            $this->biz_content['brand_name'] = $trueName;
        } else {
            throw new AliPayShopException('品牌名不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setBrandLogo(string $brandLogo)
    {
        if (ctype_alnum($brandLogo) && (\strlen($brandLogo) <= 512)) {
            $this->biz_content['brand_logo'] = $brandLogo;
        } else {
            throw new AliPayShopException('品牌LOGO不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setMainShopName(string $mainShopName)
    {
        $trueName = trim($mainShopName);
        $length = \strlen($trueName);
        if (($length > 0) && ($length <= 20)) {
            $this->biz_content['main_shop_name'] = $trueName;
        } else {
            throw new AliPayShopException('主门店名不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setBranchShopName(string $branchShopName)
    {
        $trueName = trim($branchShopName);
        $length = \strlen($trueName);
        if (($length > 0) && ($length <= 20)) {
            $this->biz_content['branch_shop_name'] = $trueName;
        } else {
            throw new AliPayShopException('分店名称不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setProvinceCode(string $provinceCode)
    {
        if (ctype_digit($provinceCode) && (\strlen($provinceCode) <= 10)) {
            $this->biz_content['province_code'] = $provinceCode;
        } else {
            throw new AliPayShopException('省份编码不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setCityCode(string $cityCode)
    {
        if (ctype_digit($cityCode) && (\strlen($cityCode) <= 10)) {
            $this->biz_content['city_code'] = $cityCode;
        } else {
            throw new AliPayShopException('城市编码不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setDistrictCode(string $districtCode)
    {
        if (ctype_digit($districtCode) && (\strlen($districtCode) <= 10)) {
            $this->biz_content['district_code'] = $districtCode;
        } else {
            throw new AliPayShopException('区县编码不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setAddress(string $address)
    {
        $length = \strlen($address);
        if (($length >= 4) && ($length <= 50)) {
            $this->biz_content['address'] = $address;
        } else {
            throw new AliPayShopException('详细地址不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @param float $lng
     * @param float $lat
     *
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setLngAndLat($lng, $lat)
    {
        if (!is_numeric($lng)) {
            throw new AliPayShopException('经度不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if ($lng < -180) {
            throw new AliPayShopException('经度不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if ($lng > 180) {
            throw new AliPayShopException('经度不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if (\strlen($lng) > 15) {
            throw new AliPayShopException('经度不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if (!is_numeric($lat)) {
            throw new AliPayShopException('纬度不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if ($lat < -90) {
            throw new AliPayShopException('纬度不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if ($lat > 90) {
            throw new AliPayShopException('纬度不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if (\strlen($lat) > 15) {
            throw new AliPayShopException('纬度不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        $this->biz_content['longitude'] = trim($lng);
        $this->biz_content['latitude'] = trim($lat);
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function addContactNumber(string $contactNumber)
    {
        if (preg_match(ProjectBase::REGEX_ALIPAY_SHOP_CONTACT, $contactNumber) > 0) {
            $this->contact_number[$contactNumber] = 1;
        } else {
            throw new AliPayShopException('门店电话号码不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setNotifyMobile(string $notifyMobile)
    {
        if (ctype_digit($notifyMobile) && (11 == \strlen($notifyMobile)) && ('1' == $notifyMobile[0])) {
            $this->biz_content['notify_mobile'] = $notifyMobile;
        } else {
            throw new AliPayShopException('店长电话号码不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setMainImage(string $mainImage)
    {
        if (ctype_alnum($mainImage) && (\strlen($mainImage) <= 512)) {
            $this->biz_content['main_image'] = $mainImage;
        } else {
            throw new AliPayShopException('门店首图不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function addAuditImage(string $auditImage)
    {
        if (ctype_alnum($auditImage) && (\strlen($auditImage) <= 512)) {
            $this->audit_images[] = $auditImage;
        } else {
            throw new AliPayShopException('审核图片不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setBusinessTime(string $businessTime)
    {
        $length = \strlen($businessTime);
        if (($length > 0) && ($length <= 256)) {
            $this->biz_content['business_time'] = $businessTime;
        } else {
            throw new AliPayShopException('营业时间不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setWifi(string $wifi)
    {
        if (\in_array($wifi, ['T', 'F'], true)) {
            $this->biz_content['wifi'] = $wifi;
        } else {
            throw new AliPayShopException('支持WIFI状态不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setParking(string $parking)
    {
        if (\in_array($parking, ['T', 'F'], true)) {
            $this->biz_content['parking'] = $parking;
        } else {
            throw new AliPayShopException('支持停车状态不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setValueAdded(string $valueAdded)
    {
        $length = \strlen($valueAdded);
        if (($length > 0) && ($length <= 256)) {
            $this->biz_content['value_added'] = $valueAdded;
        } else {
            throw new AliPayShopException('其他的服务不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setAvgPrice(int $avgPrice)
    {
        if (($avgPrice >= 100) && ($avgPrice <= 9999900)) {
            $this->biz_content['avg_price'] = number_format(($avgPrice / 100), 2, '.', '');
        } else {
            throw new AliPayShopException('人均消费价格不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setIsvUid(string $isvUid)
    {
        if (ctype_digit($isvUid) && (\strlen($isvUid) <= 16)) {
            $this->biz_content['isv_uid'] = $isvUid;
        } else {
            throw new AliPayShopException('ISV返佣id不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setLicence(string $licence)
    {
        if (ctype_alnum($licence) && (\strlen($licence) <= 512)) {
            $this->biz_content['licence'] = $licence;
        } else {
            throw new AliPayShopException('营业执照图片不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setLicenceCode(string $licenceCode)
    {
        if (\strlen($licenceCode) <= 255) {
            $this->biz_content['licence_code'] = $licenceCode;
        } else {
            throw new AliPayShopException('营业执照编号不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setLicenceName(string $licenceName)
    {
        if (\strlen($licenceName) <= 255) {
            $this->biz_content['licence_name'] = $licenceName;
        } else {
            throw new AliPayShopException('营业执照名称不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setLicenceExpires(string $licenceExpires)
    {
        if (\strlen($licenceExpires) <= 64) {
            $this->biz_content['licence_expires'] = $licenceExpires;
        } else {
            throw new AliPayShopException('营业执照过期时间不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setBusinessCertificate(string $businessCertificate)
    {
        if (ctype_alnum($businessCertificate) && (\strlen($businessCertificate) <= 512)) {
            $this->biz_content['business_certificate'] = $businessCertificate;
        } else {
            throw new AliPayShopException('许可证不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setBusinessCertificateExpires(string $businessCertificateExpires)
    {
        if (\strlen($businessCertificateExpires) <= 64) {
            $this->biz_content['business_certificate_expires'] = $businessCertificateExpires;
        } else {
            throw new AliPayShopException('许可证有效期不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setAuthLetter(string $authLetter)
    {
        if (ctype_alnum($authLetter) && (\strlen($authLetter) <= 512)) {
            $this->biz_content['auth_letter'] = $authLetter;
        } else {
            throw new AliPayShopException('授权函不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setIsOperatingOnline(string $isOperatingOnline)
    {
        if (\in_array($isOperatingOnline, ['T', 'F'], true)) {
            $this->biz_content['is_operating_online'] = $isOperatingOnline;
        } else {
            throw new AliPayShopException('其他平台开店状态不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function addOnlineUrl(string $onlineUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $onlineUrl) > 0) {
            $this->online_url[] = $onlineUrl;
        } else {
            throw new AliPayShopException('其他平台店铺链接url不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setOperateNotifyUrl(string $operateNotifyUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $operateNotifyUrl) > 0) {
            $this->biz_content['operate_notify_url'] = $operateNotifyUrl;
        } else {
            throw new AliPayShopException('审核状态消息推送地址不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function addImplementId(string $implementId)
    {
        if (ctype_alnum($implementId)) {
            $this->implement_id[$implementId] = 1;
        } else {
            throw new AliPayShopException('机具号不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setNoSmoking(string $noSmoking)
    {
        if (\in_array($noSmoking, ['T', 'F'], true)) {
            $this->biz_content['no_smoking'] = $noSmoking;
        } else {
            throw new AliPayShopException('无烟区状态不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setBox(string $box)
    {
        if (\in_array($box, ['T', 'F'], true)) {
            $this->biz_content['box'] = $box;
        } else {
            throw new AliPayShopException('包厢状态不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setRequestId(string $requestId)
    {
        if (ctype_alnum($requestId) && (\strlen($requestId) <= 64)) {
            $this->biz_content['request_id'] = $requestId;
        } else {
            throw new AliPayShopException('请求ID不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setOtherAuthorization(string $otherAuthorization)
    {
        if (ctype_alnum($otherAuthorization) && (\strlen($otherAuthorization) <= 500)) {
            $this->biz_content['other_authorization'] = $otherAuthorization;
        } else {
            throw new AliPayShopException('其他资质不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\AliPay\AliPayShopException
     */
    public function setOpRole(string $opRole)
    {
        if (\in_array($opRole, ['ISV', 'PROVIDER'], true)) {
            $this->biz_content['op_role'] = $opRole;
        } else {
            throw new AliPayShopException('操作人角色不合法', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->biz_content['store_id'])) {
            throw new AliPayShopException('门店编号不能为空', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if (!isset($this->biz_content['category_id'])) {
            throw new AliPayShopException('类目id不能为空', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if (!isset($this->biz_content['main_shop_name'])) {
            throw new AliPayShopException('主门店名不能为空', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if (!isset($this->biz_content['province_code'])) {
            throw new AliPayShopException('省份编码不能为空', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if (!isset($this->biz_content['city_code'])) {
            throw new AliPayShopException('城市编码不能为空', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if (!isset($this->biz_content['district_code'])) {
            throw new AliPayShopException('区县编码不能为空', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if (!isset($this->biz_content['address'])) {
            throw new AliPayShopException('详细地址不能为空', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if (!isset($this->biz_content['longitude'])) {
            throw new AliPayShopException('经度不能为空', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if (!isset($this->biz_content['latitude'])) {
            throw new AliPayShopException('纬度不能为空', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if (empty($this->contact_number)) {
            throw new AliPayShopException('门店电话号码不能为空', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if (!isset($this->biz_content['main_image'])) {
            throw new AliPayShopException('门店首图不能为空', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if (!isset($this->biz_content['isv_uid'])) {
            throw new AliPayShopException('ISV返佣id不能为空', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        if (!isset($this->biz_content['request_id'])) {
            throw new AliPayShopException('请求ID不能为空', ErrorCode::ALIPAY_SHOP_PARAM_ERROR);
        }
        $this->biz_content['contact_number'] = implode(',', array_keys($this->contact_number));
        if (!empty($this->audit_images)) {
            array_unique($this->audit_images);
            $this->biz_content['audit_images'] = implode(',', $this->audit_images);
        }
        if (!empty($this->online_url)) {
            array_unique($this->online_url);
            $this->biz_content['online_url'] = implode(',', $this->online_url);
        }
        if (!empty($this->implement_id)) {
            $this->biz_content['implement_id'] = implode(',', array_keys($this->implement_id));
        }

        return $this->getContent();
    }
}
