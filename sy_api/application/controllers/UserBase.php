<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/10/31 0031
 * Time: 9:49
 */
class UserBaseController extends CommonController {
    public function init(){
        parent::init();
    }

    /**
     * 清除用户缓存
     * @api {get} /Index/UserBase/clearUserCache 清除用户缓存
     * @apiDescription 清除用户缓存
     * @apiGroup UserBase
     * @apiParam {string} session_id 会话ID
     * @apiParam {string} user_id 用户ID
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "user_id","explain": "用户ID","type": "string","rules": {"required": 1,"digitlower": 1,"min": 32,"max": 32}}
     * @apiUse CommonSuccess
     * @apiUse CommonFail
     */
    public function clearUserCacheAction(){
        \Tool\SyUser::checkLogin();

        $redisKey = \Constant\Project::REDIS_PREFIX_SESSION_LIST . \Request\SyRequest::getParams('user_id');
        $sessionList = \DesignPatterns\Factories\CacheSimpleFactory::getRedisInstance()->sMembers($redisKey);
        if(!empty($sessionList)){
            foreach ($sessionList as $eSession) {
                \DesignPatterns\Factories\CacheSimpleFactory::getRedisInstance()->del(\Constant\Project::REDIS_PREFIX_SESSION . $eSession);
            }
            \DesignPatterns\Factories\CacheSimpleFactory::getRedisInstance()->del($redisKey);
        }

        $this->SyResult->setData([
            'msg' => '清除成功',
        ]);
        $this->sendRsp();
    }
}