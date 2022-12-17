<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 消息对象
 * @author auto create
 */
class MessageDTO
{
	
	/** 
	 * 会员所属组织
	 **/
	public $bu_id;
	
	/** 
	 * 会员id
	 **/
	public $cms_id;
	
	/** 
	 * 消息内容
	 **/
	public $content;
	
	/** 
	 * /**      * 文本      */     TEXT(1),      /**      * 图片      */     IMAGE(2),      /**      * 视频      */     VIDEO(3),      /**      * 链接      */     LINK(4),      /**      * 语音      */     VOICE(5),      /**      * markdown      */     MARK_DOWN(6),      /**      * 交互式卡片      */     ACTION_CARD(7),      /**      * 富文本      */     RICH_TEXT(8),      /**      * 文件      */     FILE(9),      /**      * 消息已读      */     MSG_READ(10)
	 **/
	public $content_type;
	
	/** 
	 * 钉钉的企业id
	 **/
	public $ding_corp_id;
	
	/** 
	 * 消息生成时间
	 **/
	public $message_create_at;
	
	/** 
	 * 消息id
	 **/
	public $message_id;
	
	/** 
	 * 实例id
	 **/
	public $open_instance_id;
	
	/** 
	 * 1，智能客服；1001，经济体智能客服
	 **/
	public $production_type;
	
	/** 
	 * 小二serviceId，或者会员的cmsId
	 **/
	public $sender_id;
	
	/** 
	 * 4，小二；1，会员
	 **/
	public $sender_type;
	
	/** 
	 * 会话来源
	 **/
	public $session_source;
	
	/** 
	 * 会话id
	 **/
	public $sid;	
}
?>