<?php

namespace SyDingTalk\Oapi\DingTax;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.dingtax.groupdaudata.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.12.03
 */
class GroupDauDataGetRequest extends BaseRequest
{
    /**
     * 开放群ID列表
     */
    private $openConversationIdList;
    /**
     * 统计日期(格式为 yyyymmdd)
     */
    private $statDate;

    public function setOpenConversationIdList($openConversationIdList)
    {
        $this->openConversationIdList = $openConversationIdList;
        $this->apiParas['open_conversation_id_list'] = $openConversationIdList;
    }

    public function getOpenConversationIdList()
    {
        return $this->openConversationIdList;
    }

    public function setStatDate($statDate)
    {
        $this->statDate = $statDate;
        $this->apiParas['stat_date'] = $statDate;
    }

    public function getStatDate()
    {
        return $this->statDate;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.dingtax.groupdaudata.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->openConversationIdList, 'openConversationIdList');
        RequestCheckUtil::checkMaxListSize($this->openConversationIdList, 999, 'openConversationIdList');
        RequestCheckUtil::checkNotNull($this->statDate, 'statDate');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
