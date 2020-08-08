<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/8/27 0027
 * Time: 12:26
 */
namespace SyTool;

use DesignPatterns\Factories\CacheSimpleFactory;
use DesignPatterns\Singletons\WxConfigSingleton;
use Factories\SyBaseMysqlFactory;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Wx\WxCorpProviderException;
use SyException\Wx\WxOpenException;
use SyTrait\SimpleTrait;
use Wx\CorpProvider\Common\AuthInfoGet;
use Wx\CorpProvider\Common\PermanentCode;
use Wx\OpenCommon\AuthorizerInfo;

final class ProjectWxTool
{
    use SimpleTrait;

    /**
     * 获取开放平台授权者缓存
     *
     * @param string $appId
     *
     * @return array
     *
     * @throws \SyException\Wx\WxOpenException
     */
    public static function getOpenAuthorizerCache(string $appId)
    {
        $redisKey = Project::REDIS_PREFIX_WX_COMPONENT_AUTHORIZER . $appId;
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (!isset($redisData['unique_key'])) {
            $redisData = [
                'unique_key' => $redisKey,
                'auth_code' => '',
                'refresh_token' => '',
            ];

            $commonConfig = WxConfigSingleton::getInstance()->getOpenCommonConfig();
            $openAuthorizer = SyBaseMysqlFactory::getWxopenAuthorizerEntity();
            $ormResult1 = $openAuthorizer->getContainer()->getModel()->getOrmDbTable();
            $ormResult1->where('`component_appid`=? AND `authorizer_appid`=?', [$commonConfig->getAppId(), $appId]);
            $authorizerInfo = $openAuthorizer->getContainer()->getModel()->findOne($ormResult1);
            if (empty($authorizerInfo)) {
                $redisData['authorize_status'] = Project::WX_CONFIG_AUTHORIZE_STATUS_EMPTY;
            } elseif ($authorizerInfo['authorizer_status'] == Project::WX_COMPONENT_AUTHORIZER_STATUS_ALLOW) {
                $redisData['authorize_status'] = Project::WX_CONFIG_AUTHORIZE_STATUS_YES;
                $redisData['auth_code'] = $authorizerInfo['authorizer_authcode'];
                $redisData['refresh_token'] = $authorizerInfo['authorizer_refreshtoken'];
                if (strlen($redisData['refresh_token']) == 0) {
                    $authorizerInfoObj = new AuthorizerInfo($commonConfig->getAppId());
                    $authorizerInfoObj->setAuthCode($redisData['auth_code']);
                    $authInfo = $authorizerInfoObj->getDetail();
                    if ($authInfo['code'] > 0) {
                        throw new WxOpenException($authInfo['message'], ErrorCode::WXOPEN_PARAM_ERROR);
                    }
                    $cacheData['refresh_token'] = $authInfo['data']['authorization_info']['authorizer_refresh_token'];

                    self::updateOpenAuthorizerInfo($appId, [
                        'authorizer_refreshtoken' => $authInfo['data']['authorization_info']['authorizer_refresh_token'],
                        'authorizer_allowpower' => $authInfo['data']['authorization_info']['func_info'],
                        'authorizer_info' => $authInfo['data'],
                    ]);
                }
            } else {
                $redisData['authorize_status'] = Project::WX_CONFIG_AUTHORIZE_STATUS_NO;
            }

            CacheSimpleFactory::getRedisInstance()->hMset($redisKey, $redisData);
            CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);
        }

        if (isset($redisData['unique_key']) && ($redisData['unique_key'] == $redisKey)) {
            return $redisData;
        }

        throw new WxOpenException('获取第三方授权者缓存失败', ErrorCode::WXOPEN_PARAM_ERROR);
    }

    /**
     * 处理微信开放平台公众号授权
     *
     * @param int   $optionType 操作类型
     * @param array $data
     *
     * @throws \SyException\Wx\WxOpenException
     */
    public static function handleAppAuthForOpen(int $optionType, array $data)
    {
        $nowTime = Tool::getNowTime();
        $openCommonConfig = WxConfigSingleton::getInstance()->getOpenCommonConfig();
        $openAuthorizer = SyBaseMysqlFactory::getWxopenAuthorizerEntity();
        $ormResult1 = $openAuthorizer->getContainer()->getModel()->getOrmDbTable();

        switch ($optionType) {
            case Project::WX_COMPONENT_AUTHORIZER_OPTION_TYPE_AUTHORIZED:
                $openAuthorizer->getContainer()->getModel()->insertOrUpdate($ormResult1, [
                    'component_appid' => $openCommonConfig->getAppId(),
                    'authorizer_appid' => $data['AuthorizerAppid'],
                ], [
                    'component_appid' => $openCommonConfig->getAppId(),
                    'authorizer_appid' => $data['AuthorizerAppid'],
                    'authorizer_authcode' => $data['AuthorizationCode'],
                    'authorizer_refreshtoken' => '',
                    'authorizer_allowpower' => '',
                    'authorizer_info' => '',
                    'authorizer_status' => Project::WX_COMPONENT_AUTHORIZER_STATUS_ALLOW,
                    'created' => $nowTime,
                    'updated' => $nowTime,
                ], [
                    'authorizer_authcode' => $data['AuthorizationCode'],
                    'authorizer_refreshtoken' => '',
                    'authorizer_allowpower' => '',
                    'authorizer_info' => '',
                    'authorizer_status' => Project::WX_COMPONENT_AUTHORIZER_STATUS_ALLOW,
                    'updated' => $nowTime,
                ]);

                break;
            case Project::WX_COMPONENT_AUTHORIZER_OPTION_TYPE_UNAUTHORIZED:
                $openAuthorizer->getContainer()->getModel()->insertOrUpdate($ormResult1, [
                    'component_appid' => $openCommonConfig->getAppId(),
                    'authorizer_appid' => $data['AuthorizerAppid'],
                ], [
                    'component_appid' => $openCommonConfig->getAppId(),
                    'authorizer_appid' => $data['AuthorizerAppid'],
                    'authorizer_authcode' => '',
                    'authorizer_refreshtoken' => '',
                    'authorizer_allowpower' => '',
                    'authorizer_info' => '',
                    'authorizer_status' => Project::WX_COMPONENT_AUTHORIZER_STATUS_CANCEL,
                    'created' => $nowTime,
                    'updated' => $nowTime,
                ], [
                    'authorizer_authcode' => '',
                    'authorizer_refreshtoken' => '',
                    'authorizer_allowpower' => '',
                    'authorizer_info' => '',
                    'authorizer_status' => Project::WX_COMPONENT_AUTHORIZER_STATUS_CANCEL,
                    'updated' => $nowTime,
                ]);

                break;
            case Project::WX_COMPONENT_AUTHORIZER_OPTION_TYPE_AUTHORIZED_UPDATE:
                $openAuthorizer->getContainer()->getModel()->insertOrUpdate($ormResult1, [
                    'component_appid' => $openCommonConfig->getAppId(),
                    'authorizer_appid' => $data['AuthorizerAppid'],
                ], [
                    'component_appid' => $openCommonConfig->getAppId(),
                    'authorizer_appid' => $data['AuthorizerAppid'],
                    'authorizer_authcode' => $data['AuthorizationCode'],
                    'authorizer_refreshtoken' => '',
                    'authorizer_allowpower' => '',
                    'authorizer_info' => '',
                    'authorizer_status' => Project::WX_COMPONENT_AUTHORIZER_STATUS_ALLOW,
                    'created' => $nowTime,
                    'updated' => $nowTime,
                ], [
                    'authorizer_authcode' => $data['AuthorizationCode'],
                    'authorizer_refreshtoken' => '',
                    'authorizer_allowpower' => '',
                    'authorizer_info' => '',
                    'authorizer_status' => Project::WX_COMPONENT_AUTHORIZER_STATUS_ALLOW,
                    'updated' => $nowTime,
                ]);

                break;
            default:
                throw new WxOpenException('授权操作类型不支持', ErrorCode::WXOPEN_PARAM_ERROR);
        }

        $redisKey = Project::REDIS_PREFIX_WX_COMPONENT_AUTHORIZER . $data['AuthorizerAppid'];
        CacheSimpleFactory::getRedisInstance()->del($redisKey);
    }

    /**
     * 获取服务商企业微信授权信息
     *
     * @param string $corpId 授权企业ID
     *
     * @return array
     *
     * @throws \SyException\Wx\WxOpenException
     */
    public static function getCorpProviderAuthorizerInfo(string $corpId)
    {
        $providerConfig = WxConfigSingleton::getInstance()->getCorpProviderConfig();
        $corpAuthorizer = SyBaseMysqlFactory::getWxproviderCorpAuthorizerEntity();
        $ormResult1 = $corpAuthorizer->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`suite_id`=? AND `authorizer_corpid`=?', [$providerConfig->getSuiteId(), $corpId]);
        $authorizerInfo = $corpAuthorizer->getContainer()->getModel()->findOne($ormResult1);
        if (empty($authorizerInfo)) {
            throw new WxOpenException('授权企业微信不存在', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        } elseif ($authorizerInfo['authorizer_status'] != Project::WX_PROVIDER_CORP_AUTHORIZER_STATUS_ALLOW) {
            throw new WxOpenException('企业微信已取消授权', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        return $authorizerInfo;
    }

    /**
     * 处理服务商企业微信授权
     *
     * @param int   $optionType 操作类型
     * @param array $data
     *
     * @throws \SyException\Wx\WxCorpProviderException
     */
    public static function handleAuthForCorpProvider(int $optionType, array $data)
    {
        $nowTime = Tool::getNowTime();
        $entity = SyBaseMysqlFactory::getWxproviderCorpAuthorizerEntity();
        $ormResult1 = $entity->getContainer()->getModel()->getOrmDbTable();

        switch ($optionType) {
            case Project::WX_PROVIDER_CORP_AUTHORIZER_OPTION_TYPE_AUTH_CREATE:
                $permanentCode = new PermanentCode();
                $permanentCode->setAuthCode($data['AuthCode']);
                $permanentCodeDetail = $permanentCode->getDetail();
                if ($permanentCodeDetail['code'] > 0) {
                    throw new WxCorpProviderException($permanentCodeDetail['message'], $permanentCodeDetail['code']);
                }

                $corpId = $permanentCodeDetail['data']['auth_corp_info']['corpid'];
                $authInfo = Tool::jsonEncode($permanentCodeDetail['data']['auth_info'], JSON_UNESCAPED_UNICODE);
                $authorizerInfo = Tool::jsonEncode($permanentCodeDetail['data'], JSON_UNESCAPED_UNICODE);
                $entity->getContainer()->getModel()->insertOrUpdate($ormResult1, [
                    'suite_id' => $data['SuiteId'],
                    'authorizer_corpid' => $corpId,
                ], [
                    'suite_id' => $data['SuiteId'],
                    'authorizer_corpid' => $corpId,
                    'authorizer_authcode' => $data['AuthCode'],
                    'authorizer_permanentcode' => $permanentCodeDetail['data']['permanent_code'],
                    'authorizer_allowpower' => $authInfo,
                    'authorizer_info' => $authorizerInfo,
                    'authorizer_status' => Project::WX_PROVIDER_CORP_AUTHORIZER_STATUS_ALLOW,
                    'created' => $nowTime,
                    'updated' => $nowTime,
                ], [
                    'authorizer_authcode' => $data['AuthCode'],
                    'authorizer_permanentcode' => $permanentCodeDetail['data']['permanent_code'],
                    'authorizer_allowpower' => $authInfo,
                    'authorizer_info' => $authorizerInfo,
                    'authorizer_status' => Project::WX_PROVIDER_CORP_AUTHORIZER_STATUS_ALLOW,
                    'updated' => $nowTime,
                ]);

                break;
            case Project::WX_PROVIDER_CORP_AUTHORIZER_OPTION_TYPE_AUTH_CANCEL:
                $corpId = $data['AuthCorpId'];
                $entity->getContainer()->getModel()->insertOrUpdate($ormResult1, [
                    'suite_id' => $data['SuiteId'],
                    'authorizer_corpid' => $data['AuthCorpId'],
                ], [
                    'suite_id' => $data['SuiteId'],
                    'authorizer_corpid' => $data['AuthCorpId'],
                    'authorizer_authcode' => '',
                    'authorizer_permanentcode' => '',
                    'authorizer_allowpower' => '',
                    'authorizer_info' => '',
                    'authorizer_status' => Project::WX_PROVIDER_CORP_AUTHORIZER_STATUS_CANCEL,
                    'created' => $nowTime,
                    'updated' => $nowTime,
                ], [
                    'authorizer_authcode' => '',
                    'authorizer_permanentcode' => '',
                    'authorizer_allowpower' => '',
                    'authorizer_info' => '',
                    'authorizer_status' => Project::WX_PROVIDER_CORP_AUTHORIZER_STATUS_CANCEL,
                    'updated' => $nowTime,
                ]);

                break;
            case Project::WX_PROVIDER_CORP_AUTHORIZER_OPTION_TYPE_AUTH_CHANGE:
                $ormResult1->where('`suite_id`=? AND `authorizer_corpid`=?', [$data['SuiteId'], $data['AuthCorpId']]);
                $authorizerInfo = $entity->getContainer()->getModel()->findOne($ormResult1);
                if (empty($authorizerInfo)) {
                    throw new WxCorpProviderException('企业微信未授权', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
                } elseif ($authorizerInfo['authorizer_status'] != Project::WX_PROVIDER_CORP_AUTHORIZER_STATUS_ALLOW) {
                    throw new WxCorpProviderException('企业微信已取消授权', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
                }

                $authInfoGet = new AuthInfoGet();
                $authInfoGet->setAuthCorpId($data['AuthCorpId']);
                $authInfoGet->setPermanentCode($authorizerInfo['authorizer_permanentcode']);
                $authInfoGetDetail = $authInfoGet->getDetail();
                if ($authInfoGetDetail['code'] > 0) {
                    throw new WxCorpProviderException($authInfoGetDetail['message'], $authInfoGetDetail['code']);
                }

                $corpId = $data['AuthCorpId'];
                $ormResult2 = $entity->getContainer()->getModel()->getOrmDbTable();
                $ormResult2->where('`id`=? AND `authorizer_status`=?', [$authorizerInfo['id'], $authorizerInfo['authorizer_status']]);
                $entity->getContainer()->getModel()->update($ormResult2, [
                    'authorizer_allowpower' => Tool::jsonEncode($authInfoGetDetail['data']['auth_info'], JSON_UNESCAPED_UNICODE),
                    'authorizer_info' => Tool::jsonEncode($authInfoGetDetail['data'], JSON_UNESCAPED_UNICODE),
                    'updated' => $nowTime,
                ]);

                break;
            default:
                throw new WxCorpProviderException('授权操作类型不支持', ErrorCode::WXPROVIDER_CORP_PARAM_ERROR);
        }

        $redisKey = Project::REDIS_PREFIX_WX_PROVIDER_CORP_AUTHORIZER . $corpId;
        CacheSimpleFactory::getRedisInstance()->del($redisKey);
    }

    /**
     * 更新微信开放平台授权公众号信息
     *
     * @param string $appId 授权公众号app id
     * @param array  $data
     */
    private static function updateOpenAuthorizerInfo(string $appId, array $data)
    {
        $commonConfig = WxConfigSingleton::getInstance()->getOpenCommonConfig();
        $openAuthorizer = SyBaseMysqlFactory::getWxopenAuthorizerEntity();
        $ormResult1 = $openAuthorizer->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`component_appid`=? AND `authorizer_appid`=?', [$commonConfig->getAppId(), $appId]);
        $openAuthorizer->getContainer()->getModel()->update($ormResult1, [
            'authorizer_refreshtoken' => $data['authorizer_refreshtoken'],
            'authorizer_allowpower' => Tool::jsonEncode($data['authorizer_allowpower'], JSON_UNESCAPED_UNICODE),
            'authorizer_info' => Tool::jsonEncode($data['authorizer_info'], JSON_UNESCAPED_UNICODE),
            'updated' => Tool::getNowTime(),
        ]);
    }
}
