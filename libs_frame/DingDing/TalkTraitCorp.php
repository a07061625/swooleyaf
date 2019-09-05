<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-1-27
 * Time: 下午1:03
 */
namespace DingDing;

use SyConstant\ErrorCode;
use SyException\DingDing\TalkException;

trait TalkTraitCorp
{
    /**
     * 获取access token
     * @param int $type 令牌类型
     * @param string $corpId 企业ID
     * @param string $agentTag 应用标识
     * @return string
     * @throws \SyException\DingDing\TalkException
     */
    private function getAccessToken(int $type, string $corpId, string $agentTag = '') : string
    {
        if (!ctype_alnum($corpId)) {
            throw new TalkException('企业ID不合法', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        switch ($type) {
            case TalkBaseCorp::ACCESS_TOKEN_TYPE_CORP:
                if (!ctype_alnum($agentTag)) {
                    throw new TalkException('应用标识不合法', ErrorCode::DING_TALK_PARAM_ERROR);
                }
                $accessToken = TalkUtilCorp::getAccessToken($corpId, $agentTag);
                break;
            case TalkBaseCorp::ACCESS_TOKEN_TYPE_PROVIDER:
                $accessToken = TalkUtilProvider::getAuthorizerAccessToken($corpId);
                break;
            default:
                throw new TalkException('令牌类型不支持', ErrorCode::DING_TALK_PARAM_ERROR);
        }

        return $accessToken;
    }
}
