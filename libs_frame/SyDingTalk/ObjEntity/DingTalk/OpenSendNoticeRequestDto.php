<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 发送通知入参
 *
 * @author auto create
 */
class OpenSendNoticeRequestDto
{
    /**
     * 圈子corpId+secret方式调用接口，没有agentId可以不传此时透出给用户是以圈子名字发通知。如果是isv方式的圈子应用，在圈子开通时会推送给isv agentID，必须传入agentId，会以圈子内应用的身份发通知
     */
    public $agentid;

    /**
     * 通知点击跳转的手机链接
     */
    public $mobile_url;

    /**
     * 通知的下方按钮文案
     */
    public $msg_button;

    /**
     * 通知文本内容 1-512字符
     */
    public $msg_content;

    /**
     * 通知点击跳转的pc链接
     */
    public $pc_url;

    /**
     * 接收人在圈子组织内的userid
     */
    public $receiver_userids;

    /**
     * 是否在圈子入口展示数字红点+1，默认情况只是点进圈子在通知那一栏有数字红点，该值设为true后会在圈子入口也展示数字红点
     */
    public $show_red_point;

    /**
     * 防重复，如果2个请求传入同样的uuid，第二个请求会返回成功
     */
    public $uuid;
}
