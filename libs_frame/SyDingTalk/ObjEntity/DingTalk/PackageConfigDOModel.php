<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回的数据实体
 *
 * @author auto create
 */
class PackageConfigDOModel
{
    /**
     * appid
     */
    public $app_id;

    /**
     * 构建结果url
     */
    public $build_result_url;

    /**
     * fallback
     */
    public $fallback_url;

    /**
     * 是否删除
     */
    public $is_deleted;

    /**
     * 包路径
     */
    public $package_path;

    /**
     * 包类型MAIN/SUB
     */
    public $package_type;

    /**
     * 包地址
     */
    public $package_url;

    /**
     * 大小
     */
    public $size;

    /**
     * 版本ID
     */
    public $version_unique_id;
}
