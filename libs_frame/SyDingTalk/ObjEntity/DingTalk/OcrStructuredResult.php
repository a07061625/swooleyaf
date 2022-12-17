<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 识别结果
 *
 * @author auto create
 */
class OcrStructuredResult
{
    /**
     * 旋转度
     */
    public $angle;

    /**
     * 图片识别内容json字符串，不同的类型有不同的字段，例如身份证{"姓名":"王xx","性别":"男","民族":"汉","出生日期":"1986年1月9日","住址":"四川省攀枝xxxx","身份证号码":"5101241988xxxxx"}
     */
    public $data;

    /**
     * 旋转后图片高度
     */
    public $height;

    /**
     * 原始图片高度
     */
    public $original_height;

    /**
     * 原始图片宽度
     */
    public $original_width;

    /**
     * 旋转后图片宽度
     */
    public $width;
}
