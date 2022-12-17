<?php

namespace SyDingTalk\Oapi\Mpdev;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.mpdev.build.create request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.15
 */
class BuildCreateRequest extends BaseRequest
{
    /**
     * 是否开启TabBar
     */
    private $enableTabbar;
    /**
     * 小程序默认首页
     */
    private $mainPage;
    /**
     * 小程序ID
     */
    private $miniappId;
    /**
     * 上传包Key
     */
    private $packageKey;
    /**
     * 上传包MD5
     */
    private $packageMd5;
    /**
     * 小程序版本号
     */
    private $packageVersion;
    /**
     * 静态插件信息
     */
    private $pluginRefs;

    public function setEnableTabbar($enableTabbar)
    {
        $this->enableTabbar = $enableTabbar;
        $this->apiParas['enable_tabbar'] = $enableTabbar;
    }

    public function getEnableTabbar()
    {
        return $this->enableTabbar;
    }

    public function setMainPage($mainPage)
    {
        $this->mainPage = $mainPage;
        $this->apiParas['main_page'] = $mainPage;
    }

    public function getMainPage()
    {
        return $this->mainPage;
    }

    public function setMiniappId($miniappId)
    {
        $this->miniappId = $miniappId;
        $this->apiParas['miniapp_id'] = $miniappId;
    }

    public function getMiniappId()
    {
        return $this->miniappId;
    }

    public function setPackageKey($packageKey)
    {
        $this->packageKey = $packageKey;
        $this->apiParas['package_key'] = $packageKey;
    }

    public function getPackageKey()
    {
        return $this->packageKey;
    }

    public function setPackageMd5($packageMd5)
    {
        $this->packageMd5 = $packageMd5;
        $this->apiParas['package_md5'] = $packageMd5;
    }

    public function getPackageMd5()
    {
        return $this->packageMd5;
    }

    public function setPackageVersion($packageVersion)
    {
        $this->packageVersion = $packageVersion;
        $this->apiParas['package_version'] = $packageVersion;
    }

    public function getPackageVersion()
    {
        return $this->packageVersion;
    }

    public function setPluginRefs($pluginRefs)
    {
        $this->pluginRefs = $pluginRefs;
        $this->apiParas['plugin_refs'] = $pluginRefs;
    }

    public function getPluginRefs()
    {
        return $this->pluginRefs;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.mpdev.build.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->enableTabbar, 'enableTabbar');
        RequestCheckUtil::checkNotNull($this->mainPage, 'mainPage');
        RequestCheckUtil::checkNotNull($this->miniappId, 'miniappId');
        RequestCheckUtil::checkNotNull($this->packageKey, 'packageKey');
        RequestCheckUtil::checkNotNull($this->packageMd5, 'packageMd5');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
