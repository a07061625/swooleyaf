<?php
class TaskController extends CommonController {
    public function init() {
        parent::init();
    }

    /**
     * 添加任务
     * @api {post} /Index/Task/addTask 添加任务
     * @apiDescription 添加任务
     * @apiGroup Task
     * @apiParam {string} task_title 任务名称
     * @apiParam {number} persist_type 持久化类型 1:一次性定时任务 2:间隔定时任务
     * @apiParam {string} task_url 任务url地址
     * @apiParam {string} [task_method] 任务方式,可选有GET和POST,默认为GET
     * @apiParam {number} [start_time] 开始时间戳
     * @apiParam {number} interval_time 间隔时间,单位为秒
     * @apiParam {string} [task_params] 任务参数,json格式
     * @apiParam {string} [task_desc] 任务描述
     * @SyFilter-{"field": "_ignoresign","explain": "签名标识","type": "string","rules": {"min": 0}}
     * @SyFilter-{"field": "task_title","explain": "任务名称","type": "string","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "persist_type","explain": "持久化类型","type": "int","rules": {"required": 1,"min": 1}}
     * @SyFilter-{"field": "task_url","explain": "任务url地址","type": "string","rules": {"required": 1,"url": 1}}
     * @SyFilter-{"field": "task_method","explain": "任务方式","type": "string","rules": {"min": 0,"max": 10}}
     * @SyFilter-{"field": "start_time","explain": "开始时间戳","type": "int","rules": {"min": 0}}
     * @SyFilter-{"field": "interval_time","explain": "间隔时间","type": "int","rules": {"required": 1,"min": 5,"max": 5184000}}
     * @SyFilter-{"field": "task_params","explain": "任务参数","type": "string","rules": {"min": 0}}
     * @SyFilter-{"field": "task_desc","explain": "任务描述","type": "string","rules": {"min": 0}}
     */
    public function addTaskAction() {
        $title = \Tool\ProjectTool::filterStr(\Request\SyRequest::getParams('task_title'));
        $titleLength = mb_strlen($title);
        $method = strtoupper(trim(\Request\SyRequest::getParams('task_method', 'GET')));
        $paramStr = trim(\Request\SyRequest::getParams('task_params', ''));
        $paramData = strlen($paramStr) > 0 ? \Tool\Tool::jsonDecode($paramStr) : [];
        if ($titleLength == 0) {
            $this->SyResult->setCodeMsg(\Constant\ErrorCode::COMMON_PARAM_ERROR, '任务标题不能为空');
        } else if ($titleLength > 100) {
            $this->SyResult->setCodeMsg(\Constant\ErrorCode::COMMON_PARAM_ERROR, '任务标题不能大于100个字');
        } else if(!in_array($method, ['GET', 'POST'])){
            $this->SyResult->setCodeMsg(\Constant\ErrorCode::COMMON_PARAM_ERROR, '任务方式不合法');
        } else if (!is_array($paramData)) {
            $this->SyResult->setCodeMsg(\Constant\ErrorCode::COMMON_PARAM_ERROR, '任务参数不合法');
        } else {
            $needParams = [
                'task_title' => $title,
                'task_method' => $method,
                'interval_time' => (int)\Request\SyRequest::getParams('interval_time'),
                'persist_type' => (int)\Request\SyRequest::getParams('persist_type'),
                'task_url' => (string)\Request\SyRequest::getParams('task_url'),
                'task_params' => $paramData,
                'task_desc' => \Tool\ProjectTool::filterStr(\Request\SyRequest::getParams('task_desc', ''), 2),
            ];
            $addRes = \Dao\TaskDao::addTask($needParams);
            $this->SyResult->setData($addRes);
        }

        $this->sendRsp();
    }

    /**
     * 删除任务
     * @api {get} /Index/Task/delTask 删除任务
     * @apiDescription 删除任务
     * @apiGroup Task
     * @apiParam {string} task_tag 任务标识
     * @SyFilter-{"field": "task_tag","explain": "任务标识","type": "string","rules": {"required": 1,"min": 16,"max": 16}}
     */
    public function delTaskAction() {
        $needParams = [
            'task_tag' => trim(\Request\SyRequest::getParams('task_tag')),
        ];
        $delRes = \Dao\TaskDao::delTask($needParams);
        $this->SyResult->setData($delRes);
        $this->sendRsp();
    }

    /**
     * 刷新任务,当任务因其他原因没有执行才调用
     * @api {get} /Index/Task/refreshTask 刷新任务
     * @apiDescription 刷新任务
     * @apiGroup Task
     * @apiParam {string} task_tag 任务标识
     * @SyFilter-{"field": "task_tag","explain": "任务标识","type": "string","rules": {"required": 1,"min": 16,"max": 16}}
     */
    public function refreshTaskAction() {
        $needParams = [
            'task_tag' => trim(\Request\SyRequest::getParams('task_tag')),
        ];
        $refreshRes = \Dao\TaskDao::refreshTask($needParams);
        $this->SyResult->setData($refreshRes);
        $this->sendRsp();
    }

    /**
     * 获取任务列表
     * @api {get} /Index/Task/getTaskList 获取任务列表
     * @apiDescription 获取任务列表
     * @apiGroup Task
     * @apiParam {number} [page=1] 页数
     * @apiParam {number} [limit=20] 分页限制
     * @apiParam {number} [persist_type=0] 持久化类型
     * @apiParam {number} [task_status=-2] 任务状态
     * @SyFilter-{"field": "page","explain": "页数","type": "int","rules": {"min": 0}}
     * @SyFilter-{"field": "limit","explain": "分页限制","type": "int","rules": {"min": 1,"max": 100}}
     * @SyFilter-{"field": "persist_type","explain": "持久化类型","type": "int","rules": {"min": 0}}
     * @SyFilter-{"field": "task_status","explain": "任务状态","type": "int","rules": {"min": -2}}
     */
    public function getTaskListAction() {
        $needParams = [
            'page' => (int)\Request\SyRequest::getParams('page', 1),
            'limit' => (int)\Request\SyRequest::getParams('limit', \Constant\Project::COMMON_LIMIT_DEFAULT),
            'persist_type' => (int)\Request\SyRequest::getParams('persist_type', 0),
            'task_status' => (int)\Request\SyRequest::getParams('task_status', -2),
        ];
        $getRes = \Dao\TaskDao::getTaskList($needParams);
        $this->SyResult->setData($getRes);
        $this->sendRsp();
    }

    /**
     * 获取任务日志列表
     * @api {get} /Index/Task/getTaskLogList 获取任务日志列表
     * @apiDescription 获取任务日志列表
     * @apiGroup Task
     * @apiParam {number} [page=1] 页数
     * @apiParam {number} [limit=20] 分页限制
     * @apiParam {string} task_tag 任务标识
     * @SyFilter-{"field": "page","explain": "页数","type": "int","rules": {"min": 0}}
     * @SyFilter-{"field": "limit","explain": "分页限制","type": "int","rules": {"min": 1,"max": 100}}
     * @SyFilter-{"field": "task_tag","explain": "任务标识","type": "string","rules": {"required": 1,"min": 16,"max": 16}}
     */
    public function getTaskLogListAction() {
        $needParams = [
            'page' => (int)\Request\SyRequest::getParams('page', 1),
            'limit' => (int)\Request\SyRequest::getParams('limit', \Constant\Project::COMMON_LIMIT_DEFAULT),
            'task_tag' => trim(\Request\SyRequest::getParams('task_tag')),
        ];
        $getRes = \Dao\TaskDao::getTaskLogList($needParams);
        $this->SyResult->setData($getRes);
        $this->sendRsp();
    }
}