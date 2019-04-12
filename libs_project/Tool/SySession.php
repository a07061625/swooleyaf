<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-3-30
 * Time: 上午7:46
 */
namespace Tool;

use Traits\SimpleTrait;

/**
 * Class SySession
 * 如果会话类型为缓存,继承\Tool\SySessionBase类
 * 如果会话类型为JWT,继承\Tool\SySessionJwt类
 * @package Tool
 */
class SySession extends SySessionBase {
    use SimpleTrait;
}