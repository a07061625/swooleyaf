<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 会员来源
 * @author auto create
 */
class SessionSourceDTO
{
	
	/** 
	 * /**      * H5页面      */     H5(0),     /**      * APP内嵌的链接      */     APP(1),     /**      * 微信小程序      */     WE_CHAT_APPLETS(2),     /**      * 微信公众号      */     WE_CHAT_OFFICIAL_ACCOUNTS(3)
	 **/
	public $channel;
	
	/** 
	 * 发起咨询的头像
	 **/
	public $channel_avatar_url;
	
	/** 
	 * 渠道名称
	 **/
	public $channel_nick;
	
	/** 
	 * 渠道会员id
	 **/
	public $channel_uid;
	
	/** 
	 * 渠道会员所属的系统
	 **/
	public $channel_user_source;
	
	/** 
	 * 会员id
	 **/
	public $cms_id;
	
	/** 
	 * 会话结束时间
	 **/
	public $session_end_time;
	
	/** 
	 * 会话来源
	 **/
	public $session_source;
	
	/** 
	 * 会话开始时间
	 **/
	public $session_start_time;
	
	/** 
	 * 0会话中，1已结束
	 **/
	public $session_status;
	
	/** 
	 * 会话id
	 **/
	public $sid;
	
	/** 
	 * 会话摘要
	 **/
	public $summary;	
}
?>