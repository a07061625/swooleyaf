<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 二级子节点
 * @author auto create
 */
class HrmNavBarTreePointLevel3Vo
{
    
    /**
     * 权限key
     **/
    public $auth_key;
    
    /**
     * 权限类型
     **/
    public $auth_type;
    
    /**
     * 三级子节点
     **/
    public $children;
    
    /**
     * 节点code，全局唯一
     **/
    public $code;
    
    /**
     * 节点图标
     **/
    public $icon;
    
    /**
     * 节点名称
     **/
    public $name;
    
    /**
     * 是否无权限
     **/
    public $no_permission;
    
    /**
     * 顺序
     **/
    public $order;
    
    /**
     * 路径
     **/
    public $path;
    
    /**
     * 前端跳转识别字段
     **/
    public $sub_app_code;
    
    /**
     * 跳转链接
     **/
    public $url;
}
