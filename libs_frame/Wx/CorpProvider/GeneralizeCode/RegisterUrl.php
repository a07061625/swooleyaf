<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/1/23 0023
 * Time: 8:51
 */

namespace Wx\CorpProvider\GeneralizeCode;

use SyConstant\ErrorCode;
use SyException\Wx\WxCorpProviderException;
use Wx\WxBaseCorpProvider;

/**
 * 获取推广注册链接
 *
 * @package Wx\CorpProvider\GeneralizeCode
 */
class RegisterUrl extends WxBaseCorpProvider
{
    /**
     * 注册码
     *
     * @var string
     */
    private $register_code = '';

    public function __construct()
    {
        parent::__construct();
    }

    private function __clone()
    {
        //do nothing
    }

    /**
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public function setRegisterCode(string $registerCode)
    {
        if (\strlen($registerCode) > 0) {
            $this->reqData['register_code'] = $registerCode;
        } else {
            throw new WxCorpProviderException('注册码不合法', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['register_code'])) {
            throw new WxCorpProviderException('注册码不能为空', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        return [
            'url' => 'https://open.work.weixin.qq.com/3rdservice/wework/register?register_code=' . $this->reqData['register_code'],
        ];
    }
}
