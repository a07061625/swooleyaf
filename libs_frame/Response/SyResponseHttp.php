<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/23 0023
 * Time: 9:13
 */

namespace Response;

use SyConstant\ProjectBase;
use SyTrait\SimpleTrait;

class SyResponseHttp extends SyResponse
{
    use SimpleTrait;

    /**
     * 重定向
     *
     * @param string $url 重定向链接地址
     */
    public static function redirect(string $url)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $url) > 0) {
            self::headers([
                'Location' => $url,
            ]);
        }
    }
}
