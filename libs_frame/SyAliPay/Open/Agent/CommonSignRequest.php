<?php

namespace SyAliPay\Open\Agent;

/**
 * ALIPAY API: alipay.open.agent.common.sign request
 *
 * @author auto create
 *
 * @since 1.0, 2021-06-18 16:00:22
 */
class CommonSignRequest
{
    /**
     * 支付宝生活号(原服务窗)名称（1 app_name、app_demo；2 web_sites；3 alipay_life_name；4 wechat_official_account_name。1、2、3、4至少选择一个填写）
     */
    private $alipayLifeName;
    /**
     * APP demo，格式为.apk；或者应用说明文档, 格式为.doc .docx .pdf格式（1 app_name、app_demo；2 web_sites；3 alipay_life_name；4 wechat_official_account_name。1、2、3、4至少选择一个填写）
     */
    private $appDemo;
    /**
     * 商户的APP应用名称（1 app_name、app_demo；2 web_sites；3 alipay_life_name；4 wechat_official_account_name。1、2、3、4至少选择一个填写）
     */
    private $appName;
    /**
     * 代商户操作事务编号，通过alipay.open.agent.create接口进行创建。
     */
    private $batchNo;
    /**
     * 营业执照授权函图片，个体工商户如果使用总公司或其他公司的营业执照认证需上传该授权函图片，最小5KB，最大5M，图片格式必须为：png、bmp、gif、jpg、jpeg
     */
    private $businessLicenseAuthPic;
    /**
     * 营业执照号码
     */
    private $businessLicenseNo;
    /**
     * 营业执照图片。被代创建商户运营主体为个人账户必填，企业账户无需填写。图片最小5KB，最大5M，图片格式必须为：png、bmp、gif、jpg、jpeg。
     */
    private $businessLicensePic;
    /**
     * 营业期限
     */
    private $dateLimitation;
    /**
     * 营业期限是否长期有效
     */
    private $longTerm;
    /**
     * <a href="https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.59bgD2&treeId=222&articleId=105364&docType=1#s1">商家经营类目</a> 中的“经营类目编码”
     */
    private $mccCode;
    /**
     * isv要代商户签约产品码，产品码是支付宝内部对产品的唯一标识
     */
    private $productCode;
    /**
     * 店铺内景图片，最小5KB，最大5M，图片格式必须为：png、bmp、gif、jpg、jpeg。
     */
    private $shopScenePic;
    /**
     * 店铺门头照图片，最小5KB，最大5M，图片格式必须为：png、bmp、gif、jpg、jpeg。
     */
    private $shopSignBoardPic;
    /**
     * 企业特殊资质图片，可参考
     * <a href="https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.59bgD2&treeId=222&articleId=105364&docType=1#s1">商家经营类目</a> 中的“需要的特殊资质证书”。文件最小为 5KB，最大为5M，图片格式必须为：png、bmp、gif、jpg、jpeg。
     */
    private $specialLicensePic;
    /**
     * 网站首页截图，最小5KB，最大5M，图片格式必须为：png、bmp、gif、jpg、jpeg
     */
    private $webHomeScreenshot;
    /**
     * 网站商品页截图，最小5KB，最大5M，图片格式必须为：png、bmp、gif、jpg、jpeg
     */
    private $webItemScreenshot;
    /**
     * 网站支付页截图，最小5KB，最大5M，图片格式必须为：png、bmp、gif、jpg、jpeg
     */
    private $webPayScreenshot;
    /**
     * 接入网址信息（1 app_name、app_demo；2 web_sites；3 alipay_life_name；4 wechat_official_account_name。1、2、3、4至少选择一个填写）
     */
    private $webSites;
    /**
     * 接入网址的授权涵，格式为.doc .docx .pdf格式
     */
    private $webSitesLoa;
    /**
     * 网站状态，枚举值为：已上线，未上线
     */
    private $webStatus;
    /**
     * 可以登录此网站的测试账户
     */
    private $webTestAccount;
    /**
     * 可以登录此网站的账户的密码。对应web_test_account的登录密码
     */
    private $webTestAccountPassword;
    /**
     * 微信公众号名称（1 app_name、app_demo；2 web_sites；3 alipay_life_name；4 wechat_official_account_name。1、2、3、4至少选择一个填写）
     */
    private $wechatOfficialAccountName;
    private $apiParas = [];
    private $terminalType;
    private $terminalInfo;
    private $prodCode;
    private $apiVersion = '1.0';
    private $notifyUrl;
    private $returnUrl;
    private $needEncrypt = false;

    public function setAlipayLifeName($alipayLifeName)
    {
        $this->alipayLifeName = $alipayLifeName;
        $this->apiParas['alipay_life_name'] = $alipayLifeName;
    }

    public function getAlipayLifeName()
    {
        return $this->alipayLifeName;
    }

    public function setAppDemo($appDemo)
    {
        $this->appDemo = $appDemo;
        $this->apiParas['app_demo'] = $appDemo;
    }

    public function getAppDemo()
    {
        return $this->appDemo;
    }

    public function setAppName($appName)
    {
        $this->appName = $appName;
        $this->apiParas['app_name'] = $appName;
    }

    public function getAppName()
    {
        return $this->appName;
    }

    public function setBatchNo($batchNo)
    {
        $this->batchNo = $batchNo;
        $this->apiParas['batch_no'] = $batchNo;
    }

    public function getBatchNo()
    {
        return $this->batchNo;
    }

    public function setBusinessLicenseAuthPic($businessLicenseAuthPic)
    {
        $this->businessLicenseAuthPic = $businessLicenseAuthPic;
        $this->apiParas['business_license_auth_pic'] = $businessLicenseAuthPic;
    }

    public function getBusinessLicenseAuthPic()
    {
        return $this->businessLicenseAuthPic;
    }

    public function setBusinessLicenseNo($businessLicenseNo)
    {
        $this->businessLicenseNo = $businessLicenseNo;
        $this->apiParas['business_license_no'] = $businessLicenseNo;
    }

    public function getBusinessLicenseNo()
    {
        return $this->businessLicenseNo;
    }

    public function setBusinessLicensePic($businessLicensePic)
    {
        $this->businessLicensePic = $businessLicensePic;
        $this->apiParas['business_license_pic'] = $businessLicensePic;
    }

    public function getBusinessLicensePic()
    {
        return $this->businessLicensePic;
    }

    public function setDateLimitation($dateLimitation)
    {
        $this->dateLimitation = $dateLimitation;
        $this->apiParas['date_limitation'] = $dateLimitation;
    }

    public function getDateLimitation()
    {
        return $this->dateLimitation;
    }

    public function setLongTerm($longTerm)
    {
        $this->longTerm = $longTerm;
        $this->apiParas['long_term'] = $longTerm;
    }

    public function getLongTerm()
    {
        return $this->longTerm;
    }

    public function setMccCode($mccCode)
    {
        $this->mccCode = $mccCode;
        $this->apiParas['mcc_code'] = $mccCode;
    }

    public function getMccCode()
    {
        return $this->mccCode;
    }

    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;
        $this->apiParas['product_code'] = $productCode;
    }

    public function getProductCode()
    {
        return $this->productCode;
    }

    public function setShopScenePic($shopScenePic)
    {
        $this->shopScenePic = $shopScenePic;
        $this->apiParas['shop_scene_pic'] = $shopScenePic;
    }

    public function getShopScenePic()
    {
        return $this->shopScenePic;
    }

    public function setShopSignBoardPic($shopSignBoardPic)
    {
        $this->shopSignBoardPic = $shopSignBoardPic;
        $this->apiParas['shop_sign_board_pic'] = $shopSignBoardPic;
    }

    public function getShopSignBoardPic()
    {
        return $this->shopSignBoardPic;
    }

    public function setSpecialLicensePic($specialLicensePic)
    {
        $this->specialLicensePic = $specialLicensePic;
        $this->apiParas['special_license_pic'] = $specialLicensePic;
    }

    public function getSpecialLicensePic()
    {
        return $this->specialLicensePic;
    }

    public function setWebHomeScreenshot($webHomeScreenshot)
    {
        $this->webHomeScreenshot = $webHomeScreenshot;
        $this->apiParas['web_home_screenshot'] = $webHomeScreenshot;
    }

    public function getWebHomeScreenshot()
    {
        return $this->webHomeScreenshot;
    }

    public function setWebItemScreenshot($webItemScreenshot)
    {
        $this->webItemScreenshot = $webItemScreenshot;
        $this->apiParas['web_item_screenshot'] = $webItemScreenshot;
    }

    public function getWebItemScreenshot()
    {
        return $this->webItemScreenshot;
    }

    public function setWebPayScreenshot($webPayScreenshot)
    {
        $this->webPayScreenshot = $webPayScreenshot;
        $this->apiParas['web_pay_screenshot'] = $webPayScreenshot;
    }

    public function getWebPayScreenshot()
    {
        return $this->webPayScreenshot;
    }

    public function setWebSites($webSites)
    {
        $this->webSites = $webSites;
        $this->apiParas['web_sites'] = $webSites;
    }

    public function getWebSites()
    {
        return $this->webSites;
    }

    public function setWebSitesLoa($webSitesLoa)
    {
        $this->webSitesLoa = $webSitesLoa;
        $this->apiParas['web_sites_loa'] = $webSitesLoa;
    }

    public function getWebSitesLoa()
    {
        return $this->webSitesLoa;
    }

    public function setWebStatus($webStatus)
    {
        $this->webStatus = $webStatus;
        $this->apiParas['web_status'] = $webStatus;
    }

    public function getWebStatus()
    {
        return $this->webStatus;
    }

    public function setWebTestAccount($webTestAccount)
    {
        $this->webTestAccount = $webTestAccount;
        $this->apiParas['web_test_account'] = $webTestAccount;
    }

    public function getWebTestAccount()
    {
        return $this->webTestAccount;
    }

    public function setWebTestAccountPassword($webTestAccountPassword)
    {
        $this->webTestAccountPassword = $webTestAccountPassword;
        $this->apiParas['web_test_account_password'] = $webTestAccountPassword;
    }

    public function getWebTestAccountPassword()
    {
        return $this->webTestAccountPassword;
    }

    public function setWechatOfficialAccountName($wechatOfficialAccountName)
    {
        $this->wechatOfficialAccountName = $wechatOfficialAccountName;
        $this->apiParas['wechat_official_account_name'] = $wechatOfficialAccountName;
    }

    public function getWechatOfficialAccountName()
    {
        return $this->wechatOfficialAccountName;
    }

    public function getApiMethodName()
    {
        return 'alipay.open.agent.common.sign';
    }

    public function setNotifyUrl($notifyUrl)
    {
        $this->notifyUrl = $notifyUrl;
    }

    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }

    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;
    }

    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    public function getApiParas()
    {
        return $this->apiParas;
    }

    public function getTerminalType()
    {
        return $this->terminalType;
    }

    public function setTerminalType($terminalType)
    {
        $this->terminalType = $terminalType;
    }

    public function getTerminalInfo()
    {
        return $this->terminalInfo;
    }

    public function setTerminalInfo($terminalInfo)
    {
        $this->terminalInfo = $terminalInfo;
    }

    public function getProdCode()
    {
        return $this->prodCode;
    }

    public function setProdCode($prodCode)
    {
        $this->prodCode = $prodCode;
    }

    public function setApiVersion($apiVersion)
    {
        $this->apiVersion = $apiVersion;
    }

    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    public function setNeedEncrypt($needEncrypt)
    {
        $this->needEncrypt = $needEncrypt;
    }

    public function getNeedEncrypt()
    {
        return $this->needEncrypt;
    }
}
