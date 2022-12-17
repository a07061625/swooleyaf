<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 事件列表，一次最多200个
 *
 * @author auto create
 */
class Failed
{
    /**
     * bpms_instance_change
     */
    public $bpms_instance_change;

    /**
     * bpms_task_change
     */
    public $bpms_task_change;

    /**
     * 事件类型，有20种，“user_add_org”, “user_modify_org”, “user_leave_org”,“org_admin_add”, “org_admin_remove”, “org_dept_create”, “org_dept_modify”, “org_dept_remove”, “org_remove”, “chat_add_member”, “chat_remove_member”, “chat_quit”, “chat_update_owner”, “chat_update_title”, “chat_disband”,“chat_disband_microapp”, “check_in”,“bpms_task_change”,“bpms_instance_change”,“label_user_change”, “label_conf_add”, “label_conf_modify”,“label_conf_del”
     */
    public $call_back_tag;

    /**
     * check_in
     */
    public $check_in;

    /**
     * data
     */
    public $data;

    /**
     * event_time
     */
    public $event_time;

    /**
     * org_admin_add
     */
    public $org_admin_add;

    /**
     * org_admin_remove
     */
    public $org_admin_remove;

    /**
     * org_change
     */
    public $org_change;

    /**
     * org_dept_create
     */
    public $org_dept_create;

    /**
     * org_dept_modify
     */
    public $org_dept_modify;

    /**
     * org_dept_remove
     */
    public $org_dept_remove;

    /**
     * user_add_org
     */
    public $user_add_org;

    /**
     * user_leave_org
     */
    public $user_leave_org;

    /**
     * user_modify_org
     */
    public $user_modify_org;
}
