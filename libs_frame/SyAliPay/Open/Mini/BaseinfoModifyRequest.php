<?php

namespace SyAliPay\Open\Mini;

/**
 * ALIPAY API: alipay.open.mini.baseinfo.modify request
 *
 * @author auto create
 *
 * @since 1.0, 2021-07-22 11:22:37
 */
class BaseinfoModifyRequest
{
    /**
     * 11_12;12_13。小程序类目，格式为 第一个一级类目_第一个二级类目;第二个一级类目_第二个二级类目，详细类目可以参考https://docs.open.alipay.com/api_49/alipay.open.mini.category.query接口查询mini_category_list 。
     */
    private $appCategoryIds;
    /**
     * 小程序应用描述，20-200个字。若小程序应用未设置该项内容时必传，若小程序应用已设置且无需修改则无需传入。
     */
    private $appDesc;
    /**
     * 小程序应用英文名称。若小程序应用未设置该项内容时必传，若小程序应用已设置且无需修改则无需传入。
     */
    private $appEnglishName;
    /**
     * 小程序应用logo图标，图片格式必须为：png、jpeg、jpg，建议上传像素为180*180。
     * 若小程序应用未设置该项内容时必传，若小程序应用已设置且无需修改则无需传入。
     */
    private $appLogo;
    /**
     * 小程序应用名称。若小程序应用未设置该项内容时必传，若小程序应用已设置且无需修改则无需传入。
     */
    private $appName;
    /**
     * 小程序应用简介，一句话描述小程序功能。若小程序应用未设置该项内容时必传，若小程序应用已设置且无需修改则无需传入。
     */
    private $appSlogan;
    /**
     * 新小程序前台类目。格式为 第一个一级类目_第一个二级类目;第二个一级类目_第二个二级类目_第二个三级类目。详细类目可以通过 https://docs.open.alipay.com/api_49/alipay.open.mini.category.query接口查询mini_category_list。
     * 如需申请用户信息则该项必填，否则应用后台不会展示用户信息申请入口；通过接口申请用户信息会被直接驳回。
     */
    private $miniCategoryIds;
    /**
     * 小程序客服邮箱。若小程序应用未设置该项内容时必传，若小程序应用已设置且无需修改则无需传入。
     */
    private $serviceEmail;
    /**
     * 小程序客服电话。若小程序应用未设置该项内容时必传，若小程序应用已设置且无需修改则无需传入。
     */
    private $servicePhone;
    private $apiParas = [];
    private $terminalType;
    private $terminalInfo;
    private $prodCode;
    private $apiVersion = '1.0';
    private $notifyUrl;
    private $returnUrl;
    private $needEncrypt = false;

    public function setAppCategoryIds($appCategoryIds)
    {
        $this->appCategoryIds = $appCategoryIds;
        $this->apiParas['app_category_ids'] = $appCategoryIds;
    }

    public function getAppCategoryIds()
    {
        return $this->appCategoryIds;
    }

    public function setAppDesc($appDesc)
    {
        $this->appDesc = $appDesc;
        $this->apiParas['app_desc'] = $appDesc;
    }

    public function getAppDesc()
    {
        return $this->appDesc;
    }

    public function setAppEnglishName($appEnglishName)
    {
        $this->appEnglishName = $appEnglishName;
        $this->apiParas['app_english_name'] = $appEnglishName;
    }

    public function getAppEnglishName()
    {
        return $this->appEnglishName;
    }

    public function setAppLogo($appLogo)
    {
        $this->appLogo = $appLogo;
        $this->apiParas['app_logo'] = $appLogo;
    }

    public function getAppLogo()
    {
        return $this->appLogo;
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

    public function setAppSlogan($appSlogan)
    {
        $this->appSlogan = $appSlogan;
        $this->apiParas['app_slogan'] = $appSlogan;
    }

    public function getAppSlogan()
    {
        return $this->appSlogan;
    }

    public function setMiniCategoryIds($miniCategoryIds)
    {
        $this->miniCategoryIds = $miniCategoryIds;
        $this->apiParas['mini_category_ids'] = $miniCategoryIds;
    }

    public function getMiniCategoryIds()
    {
        return $this->miniCategoryIds;
    }

    public function setServiceEmail($serviceEmail)
    {
        $this->serviceEmail = $serviceEmail;
        $this->apiParas['service_email'] = $serviceEmail;
    }

    public function getServiceEmail()
    {
        return $this->serviceEmail;
    }

    public function setServicePhone($servicePhone)
    {
        $this->servicePhone = $servicePhone;
        $this->apiParas['service_phone'] = $servicePhone;
    }

    public function getServicePhone()
    {
        return $this->servicePhone;
    }

    public function getApiMethodName()
    {
        return 'alipay.open.mini.baseinfo.modify';
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
