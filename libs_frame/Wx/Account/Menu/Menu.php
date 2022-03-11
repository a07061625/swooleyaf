<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 15:52
 */

namespace Wx\Account\Menu;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use Wx\WxBaseAccount;

class Menu extends WxBaseAccount
{
    private static $typeList = [
        'pic_weixin',
        'pic_sysphoto',
        'pic_photo_or_album',
        'view',
        'view_limited',
        'click',
        'media_id',
        'location_select',
        'scancode_push',
        'scancode_waitmsg',
    ];

    /**
     * 菜单标题
     *
     * @var string
     */
    private $name = '';

    /**
     * 子菜单
     *
     * @var array
     */
    private $sub_button = [];

    /**
     * 响应动作类型
     *
     * @var string
     */
    private $type = '';

    /**
     * 菜单KEY值，用于消息接口推送
     *
     * @var string
     */
    private $key = '';

    /**
     * 网页链接，用户点击菜单可打开链接
     *
     * @var string
     */
    private $url = '';

    /**
     * 媒体ID
     *
     * @var string
     */
    private $media_id = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setName(string $name)
    {
        if (\strlen($name) > 0) {
            $this->reqData['name'] = mb_substr($name, 0, 5);
        } else {
            throw new WxException('菜单名称不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function addSub(array $sub)
    {
        if (empty($sub)) {
            throw new WxException('子菜单不能为空', ErrorCode::WX_PARAM_ERROR);
        }

        if (\count($this->sub_button) < 5) {
            $this->sub_button[] = $sub;
        } else {
            throw  new WxException('子菜单不能超过5个', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setType(string $type)
    {
        if (\in_array($type, self::$typeList, true)) {
            $this->reqData['type'] = $type;
        } else {
            throw  new WxException('响应动作类型不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function setKey(string $key)
    {
        if (\strlen($key) > 0) {
            $this->reqData['key'] = substr($key, 0, 128);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setUrl(string $url)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $url) > 0) {
            $this->reqData['url'] = $url;
        } else {
            throw new WxException('网页链接不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setMediaId(string $mediaId)
    {
        if (\strlen($mediaId) > 0) {
            $this->reqData['media_id'] = $mediaId;
        } else {
            throw new WxException('媒体ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['name'])) {
            throw new WxException('菜单名称不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        if (!isset($this->reqData['type'])) {
            throw new WxException('响应动作类型不能为空', ErrorCode::WX_PARAM_ERROR);
        }
        $this->reqData['sub_button'] = $this->sub_button;

        return $this->reqData;
    }
}
