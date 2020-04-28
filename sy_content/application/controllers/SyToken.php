<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-19
 * Time: 下午10:58
 */
class SyTokenController extends CommonController
{
    public function init()
    {
        parent::init();
    }

    /**
     * 总站添加令牌
     * @api {post} /Index/SyToken/addTokenByStation 总站添加令牌
     * @apiDescription 总站添加令牌
     * @apiGroup SyToken
     * @apiParam {string} tag 令牌标识
     * @apiParam {string} title 标题
     * @apiParam {string} [remark] 备注
     * @apiParam {number} expire_time 到期时间
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "tag","explain": "令牌标识","type": "string","rules": {"required": 1,"digitlower": 1,"min": 8,"max": 8}}
     * @SyFilter-{"field": "title","explain": "标题","type": "string","rules": {"required": 1,"min": 1,"max": 80}}
     * @SyFilter-{"field": "remark","explain": "备注","type": "string","rules": {"min": 0}}
     * @SyFilter-{"field": "expire_time","explain": "到期时间","type": "int","rules": {"required": 1,"min": 0}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function addTokenByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $title = SyTool\ProjectTool::filterStr(\Request\SyRequest::getParams('title'), 2);
        if (strlen($title) == 0) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '标题不能为空');
        } else {
            $needParams = [
                'tag' => (string)\Request\SyRequest::getParams('tag'),
                'title' => $title,
                'remark' => trim(\Request\SyRequest::getParams('remark', '')),
                'expire_time' => (int)\Request\SyRequest::getParams('expire_time'),
            ];
            $addRes = \Dao\SyTokenDao::addTokenByStation($needParams);
            $this->SyResult->setData($addRes);
        }

        $this->sendRsp();
    }

    /**
     * 总站修改令牌
     * @api {post} /Index/SyToken/editTokenByStation 总站修改令牌
     * @apiDescription 总站修改令牌
     * @apiGroup SyToken
     * @apiParam {string} tag 令牌标识
     * @apiParam {string} title 标题
     * @apiParam {string} [remark] 备注
     * @apiParam {number} expire_time 到期时间
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "tag","explain": "令牌标识","type": "string","rules": {"required": 1,"digitlower": 1,"min": 8,"max": 8}}
     * @SyFilter-{"field": "title","explain": "标题","type": "string","rules": {"required": 1,"min": 1,"max": 80}}
     * @SyFilter-{"field": "remark","explain": "备注","type": "string","rules": {"min": 0}}
     * @SyFilter-{"field": "expire_time","explain": "到期时间","type": "int","rules": {"required": 1,"min": 0}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function editTokenByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $title = SyTool\ProjectTool::filterStr(\Request\SyRequest::getParams('title'), 2);
        if (strlen($title) == 0) {
            $this->SyResult->setCodeMsg(\SyConstant\ErrorCode::COMMON_PARAM_ERROR, '标题不能为空');
        } else {
            $needParams = [
                'tag' => (string)\Request\SyRequest::getParams('tag'),
                'title' => $title,
                'remark' => trim(\Request\SyRequest::getParams('remark', '')),
                'expire_time' => (int)\Request\SyRequest::getParams('expire_time'),
            ];
            $editRes = \Dao\SyTokenDao::editTokenByStation($needParams);
            $this->SyResult->setData($editRes);
        }

        $this->sendRsp();
    }

    /**
     * 总站获取令牌信息
     * @api {get} /Index/SyToken/getTokenInfoByStation 总站获取令牌信息
     * @apiDescription 总站获取令牌信息
     * @apiGroup SyToken
     * @apiParam {string} tag 令牌标识
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "tag","explain": "令牌标识","type": "string","rules": {"required": 1,"digitlower": 1,"min": 8,"max": 8}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getTokenInfoByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $needParams = [
            'tag' => (string)\Request\SyRequest::getParams('tag'),
        ];
        $getRes = \Dao\SyTokenDao::getTokenInfoByStation($needParams);
        $this->SyResult->setData($getRes);
        $this->sendRsp();
    }

    /**
     * 总站获取令牌列表
     * @api {get} /Index/SyToken/getTokenListByStation 总站获取令牌列表
     * @apiDescription 总站获取令牌列表
     * @apiGroup SyToken
     * @apiParam {number} [page=1] 页数
     * @apiParam {number} [limit=10] 分页限制
     * @SyFilter-{"field": "session_id","explain": "会话ID","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "page","explain": "页数","type": "int","rules": {"min": 0}}
     * @SyFilter-{"field": "limit","explain": "分页限制","type": "int","rules": {"min": 1,"max": 100}}
     * @apiUse RequestSession
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getTokenListByStationAction()
    {
        SyTool\SyUser::checkStationLogin();

        $needParams = [
            'page' => (int)\Request\SyRequest::getParams('page', 1),
            'limit' => (int)\Request\SyRequest::getParams('limit', \SyConstant\Project::COMMON_LIMIT_DEFAULT),
        ];
        $getRes = \Dao\SyTokenDao::getTokenListByStation($needParams);
        $this->SyResult->setData($getRes);
        $this->sendRsp();
    }
}
