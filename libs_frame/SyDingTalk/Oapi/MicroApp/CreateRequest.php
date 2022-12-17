<?php

namespace SyDingTalk\Oapi\MicroApp;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.microapp.create request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class CreateRequest extends BaseRequest
{
    /**
     * 钉钉测试微应用
     */
    private $appDesc;
    /**
     * 微应用的图标。需要调用上传接口将图标上传到钉钉服务器后获取到的mediaId
     */
    private $appIcon;
    /**
     * 微应用的名称。长度限制为1~10个字符
     */
    private $appName;
    /**
     * 微应用的移动端主页，必须以http开头或https开头
     */
    private $homepageUrl;
    /**
     * 微应用的OA后台管理主页，必须以http开头或https开头。微应用后台管理员免登 开发
     */
    private $ompLink;
    /**
     * 微应用的PC端主页，必须以http开头或https开头，如果不为空则必须与homepageUrl的域名一致
     */
    private $pcHomepageUrl;

    public function setAppDesc($appDesc)
    {
        $this->appDesc = $appDesc;
        $this->apiParas['appDesc'] = $appDesc;
    }

    public function getAppDesc()
    {
        return $this->appDesc;
    }

    public function setAppIcon($appIcon)
    {
        $this->appIcon = $appIcon;
        $this->apiParas['appIcon'] = $appIcon;
    }

    public function getAppIcon()
    {
        return $this->appIcon;
    }

    public function setAppName($appName)
    {
        $this->appName = $appName;
        $this->apiParas['appName'] = $appName;
    }

    public function getAppName()
    {
        return $this->appName;
    }

    public function setHomepageUrl($homepageUrl)
    {
        $this->homepageUrl = $homepageUrl;
        $this->apiParas['homepageUrl'] = $homepageUrl;
    }

    public function getHomepageUrl()
    {
        return $this->homepageUrl;
    }

    public function setOmpLink($ompLink)
    {
        $this->ompLink = $ompLink;
        $this->apiParas['ompLink'] = $ompLink;
    }

    public function getOmpLink()
    {
        return $this->ompLink;
    }

    public function setPcHomepageUrl($pcHomepageUrl)
    {
        $this->pcHomepageUrl = $pcHomepageUrl;
        $this->apiParas['pcHomepageUrl'] = $pcHomepageUrl;
    }

    public function getPcHomepageUrl()
    {
        return $this->pcHomepageUrl;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.microapp.create';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
