<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/11 0011
 * Time: 8:52
 */
namespace Wx;

abstract class WxBaseAccount extends WxBase
{
    const MATERIAL_TYPE_IMAGE = 'image';
    const MATERIAL_TYPE_VOICE = 'voice';
    const MATERIAL_TYPE_VIDEO = 'video';
    const MATERIAL_TYPE_THUMB = 'thumb';
    const MESSAGE_TYPE_MPNEWS = 'mpnews';
    const MESSAGE_TYPE_TEXT = 'text';
    const MESSAGE_TYPE_VOICE = 'voice';
    const MESSAGE_TYPE_MUSIC = 'music';
    const MESSAGE_TYPE_IMAGE = 'image';
    const MESSAGE_TYPE_VIDEO = 'video';
    const MESSAGE_TYPE_WXCARD = 'wxcard';

    protected static $totalMaterialType = [
        self::MATERIAL_TYPE_IMAGE => '图片',
        self::MATERIAL_TYPE_VOICE => '语音',
        self::MATERIAL_TYPE_VIDEO => '视频',
        self::MATERIAL_TYPE_THUMB => '缩略图',
    ];
    protected static $totalMessageType = [
        self::MESSAGE_TYPE_MPNEWS => '图文',
        self::MESSAGE_TYPE_TEXT => '文本',
        self::MESSAGE_TYPE_VOICE => '语音',
        self::MESSAGE_TYPE_MUSIC => '音乐',
        self::MESSAGE_TYPE_IMAGE => '图片',
        self::MESSAGE_TYPE_VIDEO => '视频',
        self::MESSAGE_TYPE_WXCARD => '卡券',
    ];

    public function __construct()
    {
        parent::__construct();
    }
}
