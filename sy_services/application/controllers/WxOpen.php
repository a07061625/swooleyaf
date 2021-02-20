<?php
class WxOpenController extends CommonController
{
    public function init()
    {
        parent::init();
    }

    /**
     * 处理微信服务器消息通知
     * @api {post} /Index/WxOpen/handleWxNotify 处理微信服务器消息通知
     * @apiDescription 处理微信服务器消息通知
     * @apiGroup ServiceWxOpen
     * @apiParam {string} wx_xml 微信xml消息
     * @apiParam {string} nonce 随机字符串
     * @apiParam {string} msg_signature 消息签名
     * @apiParam {string} encrypt_type 加密方式
     * @apiParam {string} timestamp 时间戳
     * @SyFilter-{"field": "wx_xml","explain": "微信xml消息","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "nonce","explain": "随机字符串","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "msg_signature","explain": "消息签名","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "encrypt_type","explain": "加密方式","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "timestamp","explain": "时间戳","type": "string","rules": {"required": 1,"min": 1}}
     * @apiSuccess {String} WxOpenSuccess 请求失败
     * @apiSuccessExample success:
     *     success
     * @apiSuccess {String} WxOpenFail 请求失败
     * @apiSuccessExample fail:
     *     fail
     */
    public function handleWxNotifyAction()
    {
        $needParams = \Request\SyRequest::getParams();
        $handleRes = \Dao\WxOpenDao::handleNotifyWx($needParams);
        $this->SyResult->setData([
            'result' => $handleRes,
        ]);
        $this->sendRsp();
    }

    /**
     * 处理授权者公众号消息
     * @api {post} /Index/WxOpen/handleAuthorizerNotify 处理授权者公众号消息
     * @apiDescription 处理授权者公众号消息
     * @apiGroup ServiceWxOpen
     * @apiParam {string} wx_xml 微信xml消息
     * @apiParam {string} appid 授权者公众号id
     * @apiParam {string} openid 用户openid
     * @apiParam {string} nonce 随机字符串
     * @apiParam {string} msg_signature 消息签名
     * @apiParam {string} encrypt_type 加密方式
     * @apiParam {string} timestamp 时间戳
     * @SyFilter-{"field": "wx_xml","explain": "微信xml消息","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "appid","explain": "授权者公众号id","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "openid","explain": "用户openid","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "nonce","explain": "随机字符串","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "msg_signature","explain": "消息签名","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "encrypt_type","explain": "加密方式","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "timestamp","explain": "时间戳","type": "string","rules": {"required": 1,"min": 1}}
     * @apiSuccess {String} WxOpenSuccess 请求失败
     * @apiSuccessExample success:
     *     <xml><ToUserName>fafasdf</ToUserName><Encrypt>dfdsfaf</Encrypt></xml>
     * @apiSuccess {String} WxOpenFail 请求失败
     * @apiSuccessExample fail:
     *     fail
     */
    public function handleAuthorizerNotifyAction()
    {
        $needParams = \Request\SyRequest::getParams();
        $handleRes = \Dao\WxOpenDao::handleNotifyAuthorizer($needParams);
        $this->SyResult->setData([
            'result' => $handleRes,
        ]);
        $this->sendRsp();
    }
}
