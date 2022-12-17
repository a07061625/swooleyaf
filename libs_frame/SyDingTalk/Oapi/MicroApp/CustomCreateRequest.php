<?php

namespace SyDingTalk\Oapi\MicroApp;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.microapp.custom.create request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.12
 */
class CustomCreateRequest extends BaseRequest
{
    /**
     * 定制应用所属企业
     */
    private $appCorpId;
    /**
     * 微应用描述
     */
    private $desc;
    /**
     * 微应用类型0 H5 1小程序
     */
    private $developType;
    /**
     * 移动端地址
     */
    private $homepageLink;
    /**
     * 微应用图标, /media/upload生成
     */
    private $icon;
    /**
     * “1.1.1.1,2.2.2.2”
     */
    private $ipWhiteList;
    /**
     * 微应用名称
     */
    private $name;
    /**
     * 管理后台地址
     */
    private $ompLink;
    /**
     * PC端地址
     */
    private $pcHomepageLink;
    /**
     * 定制应用所属企业的顶级管理组织，通过该组织判断调用接口的白名单
     */
    private $topRelatedCorpId;

    public function setAppCorpId($appCorpId)
    {
        $this->appCorpId = $appCorpId;
        $this->apiParas['app_corp_id'] = $appCorpId;
    }

    public function getAppCorpId()
    {
        return $this->appCorpId;
    }

    public function setDesc($desc)
    {
        $this->desc = $desc;
        $this->apiParas['desc'] = $desc;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function setDevelopType($developType)
    {
        $this->developType = $developType;
        $this->apiParas['develop_type'] = $developType;
    }

    public function getDevelopType()
    {
        return $this->developType;
    }

    public function setHomepageLink($homepageLink)
    {
        $this->homepageLink = $homepageLink;
        $this->apiParas['homepage_link'] = $homepageLink;
    }

    public function getHomepageLink()
    {
        return $this->homepageLink;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
        $this->apiParas['icon'] = $icon;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIpWhiteList($ipWhiteList)
    {
        $this->ipWhiteList = $ipWhiteList;
        $this->apiParas['ip_white_list'] = $ipWhiteList;
    }

    public function getIpWhiteList()
    {
        return $this->ipWhiteList;
    }

    public function setName($name)
    {
        $this->name = $name;
        $this->apiParas['name'] = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setOmpLink($ompLink)
    {
        $this->ompLink = $ompLink;
        $this->apiParas['omp_link'] = $ompLink;
    }

    public function getOmpLink()
    {
        return $this->ompLink;
    }

    public function setPcHomepageLink($pcHomepageLink)
    {
        $this->pcHomepageLink = $pcHomepageLink;
        $this->apiParas['pc_homepage_link'] = $pcHomepageLink;
    }

    public function getPcHomepageLink()
    {
        return $this->pcHomepageLink;
    }

    public function setTopRelatedCorpId($topRelatedCorpId)
    {
        $this->topRelatedCorpId = $topRelatedCorpId;
        $this->apiParas['top_related_corp_id'] = $topRelatedCorpId;
    }

    public function getTopRelatedCorpId()
    {
        return $this->topRelatedCorpId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.microapp.custom.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->appCorpId, 'appCorpId');
        RequestCheckUtil::checkNotNull($this->desc, 'desc');
        RequestCheckUtil::checkNotNull($this->name, 'name');
        RequestCheckUtil::checkNotNull($this->topRelatedCorpId, 'topRelatedCorpId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
