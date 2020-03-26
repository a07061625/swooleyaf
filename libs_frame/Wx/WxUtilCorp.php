<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/12 0012
 * Time: 17:04
 */
namespace Wx;

use SyConstant\ErrorCode;
use SyConstant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use DesignPatterns\Singletons\WxConfigSingleton;
use SyException\Wx\WxException;
use SyTool\Tool;
use SyTrait\SimpleTrait;
use Wx\Corp\Common\AccessToken;
use Wx\Corp\Common\JsTicket;

final class WxUtilCorp extends WxUtilBase
{
    use SimpleTrait;

    /**
     * 获取access token
     * @param string $corpId
     * @param string $agentTag
     * @return string
     */
    public static function getAccessToken(string $corpId, string $agentTag) : string
    {
        $nowTime = Tool::getNowTime();
        $agentInfo = WxConfigSingleton::getInstance()->getCorpConfig($corpId)->getAgentInfo($agentTag);
        $redisKey = Project::REDIS_PREFIX_WX_CORP . $corpId . '_' . $agentInfo['id'];
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['at_key']) && ($redisData['at_key'] == $redisKey) && ($redisData['at_expire'] >= $nowTime)) {
            return $redisData['at_content'];
        }

        $accessTokenObj = new AccessToken($corpId, $agentTag);
        $accessTokenDetail = $accessTokenObj->getDetail();
        unset($accessTokenObj);

        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'at_content' => $accessTokenDetail['access_token'],
            'at_expire' => (int)($nowTime + $accessTokenDetail['expires_in'] - 10),
            'at_key' => $redisKey,
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 8000);

        return $accessTokenDetail['access_token'];
    }

    /**
     * 获取js ticket
     * @param string $corpId
     * @param string $agentTag
     * @return string
     */
    public static function getJsTicket(string $corpId, string $agentTag) : string
    {
        $nowTime = Tool::getNowTime();
        $agentInfo = WxConfigSingleton::getInstance()->getCorpConfig($corpId)->getAgentInfo($agentTag);
        $redisKey = Project::REDIS_PREFIX_WX_CORP . $corpId . '_' . $agentInfo['id'];
        $redisData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (isset($redisData['jt_key']) && ($redisData['jt_key'] == $redisKey) && ($redisData['jt_expire'] >= $nowTime)) {
            return $redisData['jt_content'];
        }

        $accessToken = self::getAccessToken($corpId, $agentTag);
        $jsTicketObj = new JsTicket();
        $jsTicketObj->setAccessToken($accessToken);
        $jsTicketDetail = $jsTicketObj->getDetail();
        unset($jsTicketObj);

        CacheSimpleFactory::getRedisInstance()->hMset($redisKey, [
            'jt_content' => $jsTicketDetail['ticket'],
            'jt_expire' => (int)($nowTime + $jsTicketDetail['expires_in'] - 10),
            'jt_key' => $redisKey,
        ]);
        CacheSimpleFactory::getRedisInstance()->expire($redisKey, 8000);

        return $jsTicketDetail['ticket'];
    }

    /**
     * 生成微信签名
     * @param array $data 待签名数据,包括企业微信签名字段workwx_sign
     * @param string $payKey 支付密钥
     * @return string
     */
    public static function createWxSign(array $data, string $payKey)
    {
        //签名步骤一：按字典序排序参数
        ksort($data);
        //签名步骤二：格式化后加入KEY
        $needStr1 = '';
        foreach ($data as $key => $value) {
            if ($key == 'sign') {
                continue;
            }
            if ((!is_string($value)) && !is_numeric($value)) {
                continue;
            }
            if (strlen($value) == 0) {
                continue;
            }
            $needStr1 .= '&' . $key . '=' . $value;
        }
        $needStr2 = substr($needStr1, 1) . $payKey;
        //签名步骤三：加密并转为大写
        return strtoupper(md5($needStr2));
    }

    /**
     * 生成企业微信签名
     * @param array $data 待签名数据
     * @param array $acceptKeys 允许参与签名的字段名列表
     * @param string $agentSecret 应用密钥
     * @return string
     * @throws \SyException\Wx\WxException
     */
    public static function createCorpSign(array $data, array $acceptKeys, string $agentSecret)
    {
        $dataKeys = array_keys($data);
        $missArr = array_diff($acceptKeys, $dataKeys);
        if (!empty($missArr)) {
            throw new WxException('缺少字段' . implode(',', $missArr), ErrorCode::WX_PARAM_ERROR);
        }

        $acceptData = [];
        foreach ($acceptKeys as $eKey) {
            $acceptData[$eKey] = $data[$eKey];
        }
        ksort($acceptData);
        $needStr1 = '';
        foreach ($acceptData as $key => $val) {
            $needStr1 .= '&' . $key . '=' . $val;
        }
        $needStr2 = substr($needStr1, 1) . $agentSecret;
        return strtoupper(md5($needStr2));
    }
}
