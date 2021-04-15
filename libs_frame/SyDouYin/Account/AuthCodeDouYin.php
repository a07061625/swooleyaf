<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/4/15 0015
 * Time: 17:12
 */
namespace SyDouYin\Account;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyDouYin\BaseAccount;
use SyDouYin\Util;
use SyException\DouYin\DouYinAccountException;
use SyTool\Tool;

/**
 * 抖音获取授权临时票据
 * @package SyDouYin\Account
 */
class AuthCodeDouYin extends BaseAccount
{
    public function __construct(string $clientKey)
    {
        parent::__construct($clientKey);
        $this->serviceHost = Util::SERVICE_HOST_TYPE_DOUYIN;
        $this->serviceUri = '/platform/oauth/connect/';
        $this->reqData = [
            'client_key' => $this->clientKey,
            'response_type' => 'code',
            'state' => Tool::createNonceStr(8, 'numlower'),
        ];
    }

    private function __clone()
    {
    }

    /**
     * @param array $scopes 授权作用域列表
     * @throws \SyException\DouYin\DouYinAccountException
     */
    public function setScopes(array $scopes)
    {
        $trueScopes = [];
        foreach ($scopes as $eKey => $eVal) {
            $trueKey = is_string($eKey) ? trim($eKey) : '';
            if (strlen($trueKey) == 0) {
                continue;
            }
            if (!in_array($eVal, [0, 1], true)) {
                continue;
            }
            $trueScopes[$trueKey] = $eVal;
        }
        if (empty($trueScopes)) {
            throw new DouYinAccountException('授权作用域不能为空', ErrorCode::DOUYIN_ACCOUNT_PARAM_ERROR);
        }

        $scopeStr1 = '';
        $scopeStr2 = '';
        foreach ($trueScopes as $key => $val) {
            $scopeStr1 .= ',' . $key;
            $scopeStr2 .= ',' . $key . ',' . $val;
        }
        $this->reqData['scope'] = substr($scopeStr1, 1);
        $this->reqData['optionalScope'] = substr($scopeStr2, 1);
    }

    /**
     * @param string $redirectUri 回调地址
     * @throws \SyException\DouYin\DouYinAccountException
     */
    public function setRedirectUri(string $redirectUri)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $redirectUri) > 0) {
            $this->reqData['redirect_uri'] = $redirectUri;
        } else {
            throw new DouYinAccountException('回调地址不合法', ErrorCode::DOUYIN_ACCOUNT_PARAM_ERROR);
        }
    }

    /**
     * @param string $state 状态码
     * @throws \SyException\DouYin\DouYinAccountException
     */
    public function setState(string $state)
    {
        if (strlen($state) > 0) {
            $this->reqData['state'] = $state;
        } else {
            throw new DouYinAccountException('状态码不合法', ErrorCode::DOUYIN_ACCOUNT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['scope'])) {
            throw new DouYinAccountException('授权作用域不能为空', ErrorCode::DOUYIN_ACCOUNT_PARAM_ERROR);
        }
        if (!isset($this->reqData['redirect_uri'])) {
            throw new DouYinAccountException('回调地址不能为空', ErrorCode::DOUYIN_ACCOUNT_PARAM_ERROR);
        }
        $this->serviceUri .= '?' . http_build_query($this->reqData);
        $this->getContent();

        return $this->curlConfigs;
    }
}
