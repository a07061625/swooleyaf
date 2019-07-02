<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/7/2 0002
 * Time: 9:41
 */
class WebHookController extends CommonController
{
    public function init()
    {
        parent::init();
    }

    /**
     * 处理码市通知
     * @api {post} /Index/WebHook/codingHandle 处理码市通知
     * @apiDescription 处理码市通知
     * @apiGroup WebHook
     * @SyFilter-{"field": "_ignoresign","explain": "签名标识","type": "string","rules": {"min": 0}}
     */
    public function codingHandleAction()
    {
        $postData = \Tool\Tool::getArrayVal($GLOBALS, 'HTTP_RAW_POST_DATA', '');
        if (strlen($postData) > 0) {
            $postArr = \Tool\Tool::jsonDecode($postData);
            if (!is_array($postArr)) {
                $postArr = [];
            }
        } else {
            $postArr = [];
        }

        if (!isset($postArr['ref'])) {
            $this->SyResult->setCodeMsg(\Constant\ErrorCode::COMMON_PARAM_ERROR, '数据不合法');
        } else {
            $redisKey = \ProjectCache\WebHook::getCacheQueueKey();
            \DesignPatterns\Factories\CacheSimpleFactory::getRedisInstance()->lPush($redisKey, \Tool\Tool::jsonEncode([
                'tag' => hash('crc32b', $postArr['repository']['url'] . $postArr['ref']),
                'event' => $_SERVER['X-CODING-EVENT'],
                'msg_prefix' => substr($postArr['head_commit']['message'], 0, 4),
            ]));
            \DesignPatterns\Factories\CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);
            $this->SyResult->setData([
                'msg' => 'accept success',
            ]);
        }

        $this->sendRsp();
    }
}
