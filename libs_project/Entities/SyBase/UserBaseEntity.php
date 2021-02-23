<?php

namespace Entities\SyBase;

use DB\Entities\MysqlEntity;

class UserBaseEntity extends MysqlEntity
{
    /**
     * @var int
     */
    public $id = 0;

    /**
     * 用户ID
     *
     * @var string
     */
    public $uid;

    /**
     * 昵称
     *
     * @var string
     */
    public $nickname = '';

    /**
     * 头像图片
     *
     * @var string
     */
    public $head_image = '';

    /**
     * 性别
     *
     * @var int
     */
    public $sex = 0;

    /**
     * 手机号码
     *
     * @var string
     */
    public $phone;

    /**
     * 密码
     *
     * @var string
     */
    public $pwd = '';

    /**
     * 加密盐
     *
     * @var string
     */
    public $pwd_salt = '';

    /**
     * 最后登录时间
     *
     * @var int
     */
    public $login_time = 0;

    /**
     * 微信openid
     *
     * @var string
     */
    public $wx_openid = '';

    /**
     * 微信unid
     *
     * @var string
     */
    public $wx_unid;

    /**
     * 1正常,0异常
     *
     * @var int
     */
    public $status = 1;

    /**
     * 创建时间戳
     *
     * @var int
     */
    public $created = 0;

    /**
     * 修改时间戳
     *
     * @var int
     */
    public $updated = 0;

    public function __construct(string $dbTag = '')
    {
        $trueTag = isset($dbTag[0]) ? $dbTag : 'main';
        parent::__construct($trueTag, 'user_base', 'uid');
    }
}
