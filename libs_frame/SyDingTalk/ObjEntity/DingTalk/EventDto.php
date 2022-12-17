<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 事件对象
 *
 * @author auto create
 */
class EventDto
{
    /**
     * 事件业务类型，参考com.dingtalk.customerservice.common.EventBizTypeEnum
     */
    public $biz_type;

    /**
     * buId(租户id)
     */
    public $bu_id;

    /**
     * 钉钉corpId
     */
    public $ding_corp_id;

    /**
     * 事件变更内容，json格式
     */
    public $event_body;

    /**
     * 事件code，参考com.dingtalk.customerservice.common.EventBizTypeEnum
     */
    public $event_code;

    /**
     * 事件的唯一性id，用于幂等
     */
    public $event_id;

    /**
     * 实例id
     */
    public $open_instance_id;

    /**
     * 1，智能客服；1001，经济体版本
     */
    public $production_type;

    /**
     * 事件来源，com.dingtalk.customerservice.common.SourceEnum
     */
    public $source;
}
