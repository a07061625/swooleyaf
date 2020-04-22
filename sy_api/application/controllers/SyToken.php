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
     */
    public function addTokenByStationAction()
    {
        $data = $_POST;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $addRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/SyToken/addTokenByStation', $data);
        $this->sendRsp($addRes);
    }

    /**
     * 总站修改令牌
     */
    public function editTokenByStationAction()
    {
        $data = $_POST;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $editRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/SyToken/editTokenByStation', $data);
        $this->sendRsp($editRes);
    }

    /**
     * 总站获取令牌信息
     */
    public function getTokenInfoByStationAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/SyToken/getTokenInfoByStation', $data);
        $this->sendRsp($getRes);
    }

    /**
     * 总站获取令牌列表
     */
    public function getTokenListByStationAction()
    {
        $data = $_GET;
        $data['session_id'] = SyTool\SySession::getSessionId();
        $getRes = \SyModule\SyModuleContent::getInstance()->sendApiReq('/Index/SyToken/getTokenListByStation', $data);
        $this->sendRsp($getRes);
    }

    /**
     * 前端获取令牌信息
     * @api {get} /Index/SyToken/getTokenInfoByFront 前端获取令牌信息
     * @apiDescription 前端获取令牌信息
     * @apiGroup SyToken
     * @apiParam {string} tag 令牌标识
     * @SyFilter-{"field": "tag","explain": "令牌标识","type": "string","rules": {"required": 1,"digitlower": 1,"min": 8,"max": 8}}
     * @apiUse ResponseSuccess
     * @apiUse ResponseFail
     */
    public function getTokenInfoByFrontAction()
    {
        $tag = (string)\Request\SyRequest::getParams('tag');
        $tokenInfo = \ProjectCache\SyToken::getTokenData($tag);
        $this->SyResult->setData($tokenInfo);
        $this->sendRsp();
    }
}
