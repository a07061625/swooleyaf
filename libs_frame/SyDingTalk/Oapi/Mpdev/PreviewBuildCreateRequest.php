<?php

namespace SyDingTalk\Oapi\Mpdev;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.mpdev.previewbuild.create request
 *
 * @author auto create
 *
 * @since 1.0, 2021.08.17
 */
class PreviewBuildCreateRequest extends BaseRequest
{
    /**
     * SDK构建脚本版本
     */
    private $buildScriptVersion;
    /**
     * 远程调试的channel
     */
    private $channel;
    /**
     * scheme中corpId值
     */
    private $corpid;
    /**
     * 开启tabBar
     */
    private $enableTabbar;
    /**
     * 忽略http安全域名检查
     */
    private $ignoreHttpReqPermission;
    /**
     * 忽略web-view安全域名检查
     */
    private $ignoreWebviewDomainCheck;
    /**
     * 远程调试模式
     */
    private $isRemoteDebug;
    /**
     * remoteX远程调试模式
     */
    private $isRemoteX;
    /**
     * 包默认主页
     */
    private $mainPage;
    /**
     * 小程序ID
     */
    private $miniappId;
    /**
     * 预览上传包地址
     */
    private $packageKey;
    /**
     * scheme page参数
     */
    private $page;
    /**
     * 插件预览包地址
     */
    private $pluginPackageKey;
    /**
     * 静态插件信息
     */
    private $pluginRefs;
    /**
     * scheme query参数
     */
    private $query;
    /**
     * 分包数据
     */
    private $subPackages;
    /**
     * 远程调试tyroid
     */
    private $tyroid;

    public function setBuildScriptVersion($buildScriptVersion)
    {
        $this->buildScriptVersion = $buildScriptVersion;
        $this->apiParas['build_script_version'] = $buildScriptVersion;
    }

    public function getBuildScriptVersion()
    {
        return $this->buildScriptVersion;
    }

    public function setChannel($channel)
    {
        $this->channel = $channel;
        $this->apiParas['channel'] = $channel;
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function setCorpid($corpid)
    {
        $this->corpid = $corpid;
        $this->apiParas['corpid'] = $corpid;
    }

    public function getCorpid()
    {
        return $this->corpid;
    }

    public function setEnableTabbar($enableTabbar)
    {
        $this->enableTabbar = $enableTabbar;
        $this->apiParas['enable_tabbar'] = $enableTabbar;
    }

    public function getEnableTabbar()
    {
        return $this->enableTabbar;
    }

    public function setIgnoreHttpReqPermission($ignoreHttpReqPermission)
    {
        $this->ignoreHttpReqPermission = $ignoreHttpReqPermission;
        $this->apiParas['ignore_http_req_permission'] = $ignoreHttpReqPermission;
    }

    public function getIgnoreHttpReqPermission()
    {
        return $this->ignoreHttpReqPermission;
    }

    public function setIgnoreWebviewDomainCheck($ignoreWebviewDomainCheck)
    {
        $this->ignoreWebviewDomainCheck = $ignoreWebviewDomainCheck;
        $this->apiParas['ignore_webview_domain_check'] = $ignoreWebviewDomainCheck;
    }

    public function getIgnoreWebviewDomainCheck()
    {
        return $this->ignoreWebviewDomainCheck;
    }

    public function setIsRemoteDebug($isRemoteDebug)
    {
        $this->isRemoteDebug = $isRemoteDebug;
        $this->apiParas['is_remote_debug'] = $isRemoteDebug;
    }

    public function getIsRemoteDebug()
    {
        return $this->isRemoteDebug;
    }

    public function setIsRemoteX($isRemoteX)
    {
        $this->isRemoteX = $isRemoteX;
        $this->apiParas['is_remote_x'] = $isRemoteX;
    }

    public function getIsRemoteX()
    {
        return $this->isRemoteX;
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

    public function setPage($page)
    {
        $this->page = $page;
        $this->apiParas['page'] = $page;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPluginPackageKey($pluginPackageKey)
    {
        $this->pluginPackageKey = $pluginPackageKey;
        $this->apiParas['plugin_package_key'] = $pluginPackageKey;
    }

    public function getPluginPackageKey()
    {
        return $this->pluginPackageKey;
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

    public function setQuery($query)
    {
        $this->query = $query;
        $this->apiParas['query'] = $query;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function setSubPackages($subPackages)
    {
        $this->subPackages = $subPackages;
        $this->apiParas['sub_packages'] = $subPackages;
    }

    public function getSubPackages()
    {
        return $this->subPackages;
    }

    public function setTyroid($tyroid)
    {
        $this->tyroid = $tyroid;
        $this->apiParas['tyroid'] = $tyroid;
    }

    public function getTyroid()
    {
        return $this->tyroid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.mpdev.previewbuild.create';
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
        RequestCheckUtil::checkNotNull($this->pluginPackageKey, 'pluginPackageKey');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
