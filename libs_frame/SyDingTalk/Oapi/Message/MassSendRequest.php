<?php

namespace SyDingTalk\Oapi\Message;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.message.mass.send request
 *
 * @author auto create
 *
 * @since 1.0, 2022.04.14
 */
class MassSendRequest extends BaseRequest
{
    /**
     * 接收者的部门id列表，接收者是部门id下(包括子部门下)的所有用户
     */
    private $depIdList;
    /**
     * 是否预览推送
     */
    private $isPreview;
    /**
     * 是否群发给所有订阅者，true-是，false-否
     */
    private $isToAll;
    /**
     * 消息卡片素材id
     */
    private $mediaId;
    /**
     * 消息体
     */
    private $msgBody;
    /**
     * msg_type, 消息类型：text，文本类型，此时文本内容填在text_content字段中；news_card，消息卡片，此时的media_id通过消息卡片上传接口得到； image，图片，此时的media_id通过图片上传接口得到
     */
    private $msgType;
    /**
     * 文本内容，当msg_type为text时有效
     */
    private $textContent;
    /**
     * 服务号的unionid
     */
    private $unionid;
    /**
     * 接收者的用户userid列表
     */
    private $useridList;
    /**
     * 调用时填写随机生成的UUID, 防止消息重复发送
     */
    private $uuid;

    public function setDepIdList($depIdList)
    {
        $this->depIdList = $depIdList;
        $this->apiParas['dep_id_list'] = $depIdList;
    }

    public function getDepIdList()
    {
        return $this->depIdList;
    }

    public function setIsPreview($isPreview)
    {
        $this->isPreview = $isPreview;
        $this->apiParas['is_preview'] = $isPreview;
    }

    public function getIsPreview()
    {
        return $this->isPreview;
    }

    public function setIsToAll($isToAll)
    {
        $this->isToAll = $isToAll;
        $this->apiParas['is_to_all'] = $isToAll;
    }

    public function getIsToAll()
    {
        return $this->isToAll;
    }

    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;
        $this->apiParas['media_id'] = $mediaId;
    }

    public function getMediaId()
    {
        return $this->mediaId;
    }

    public function setMsgBody($msgBody)
    {
        $this->msgBody = $msgBody;
        $this->apiParas['msg_body'] = $msgBody;
    }

    public function getMsgBody()
    {
        return $this->msgBody;
    }

    public function setMsgType($msgType)
    {
        $this->msgType = $msgType;
        $this->apiParas['msg_type'] = $msgType;
    }

    public function getMsgType()
    {
        return $this->msgType;
    }

    public function setTextContent($textContent)
    {
        $this->textContent = $textContent;
        $this->apiParas['text_content'] = $textContent;
    }

    public function getTextContent()
    {
        return $this->textContent;
    }

    public function setUnionid($unionid)
    {
        $this->unionid = $unionid;
        $this->apiParas['unionid'] = $unionid;
    }

    public function getUnionid()
    {
        return $this->unionid;
    }

    public function setUseridList($useridList)
    {
        $this->useridList = $useridList;
        $this->apiParas['userid_list'] = $useridList;
    }

    public function getUseridList()
    {
        return $this->useridList;
    }

    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
        $this->apiParas['uuid'] = $uuid;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.message.mass.send';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->depIdList, 2000, 'depIdList');
        RequestCheckUtil::checkNotNull($this->isToAll, 'isToAll');
        RequestCheckUtil::checkMaxLength($this->mediaId, 256, 'mediaId');
        RequestCheckUtil::checkNotNull($this->msgType, 'msgType');
        RequestCheckUtil::checkMaxLength($this->msgType, 32, 'msgType');
        RequestCheckUtil::checkMaxLength($this->textContent, 65535, 'textContent');
        RequestCheckUtil::checkNotNull($this->unionid, 'unionid');
        RequestCheckUtil::checkMaxLength($this->unionid, 128, 'unionid');
        RequestCheckUtil::checkMaxListSize($this->useridList, 10000, 'useridList');
        RequestCheckUtil::checkNotNull($this->uuid, 'uuid');
        RequestCheckUtil::checkMaxLength($this->uuid, 128, 'uuid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
