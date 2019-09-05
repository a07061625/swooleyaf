<?php
namespace Wx;

use SyConstant\ErrorCode;
use SyException\Wx\WxException;

trait WxTraitCorp
{
    /**
     * 获取access token
     * @param int $type 令牌类型
     * @param string $corpId 企业ID
     * @param string $agentTag 应用标识
     * @return string
     * @throws \SyException\Wx\WxException
     */
    private function getAccessToken(int $type, string $corpId, string $agentTag = '') : string
    {
        if (!ctype_alnum($corpId)) {
            throw new WxException('企业ID不合法', ErrorCode::WX_PARAM_ERROR);
        }

        switch ($type) {
            case WxBaseCorp::ACCESS_TOKEN_TYPE_CORP:
                if (!ctype_alnum($agentTag)) {
                    throw new WxException('应用标识不合法', ErrorCode::WX_PARAM_ERROR);
                }
                $accessToken = WxUtilCorp::getAccessToken($corpId, $agentTag);
                break;
            case WxBaseCorp::ACCESS_TOKEN_TYPE_PROVIDER:
                $accessToken = WxUtilCorpProvider::getAuthorizerAccessToken($corpId);
                break;
            default:
                throw new WxException('令牌类型不支持', ErrorCode::WX_PARAM_ERROR);
        }

        return $accessToken;
    }
}
