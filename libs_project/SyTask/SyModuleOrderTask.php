<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/10
 * Time: 13:32
 */
namespace SyTask;

use Constant\Project;

class SyModuleOrderTask extends SyModuleTaskBase implements SyModuleTaskInterface {
    public function __construct() {
        parent::__construct();
        $this->moduleTag = Project::MODULE_NAME_ORDER;
    }

    private function __clone() {
    }

    public function handleTask(array $data) {
        if($data['clear_localuser']){ //清除本地用户信息缓存
            $this->clearLocalUserCache([
                'projects' => $data['projects'],
            ], '');
        }
        if($data['clear_localwx']){
            $this->clearLocalWxCache([
                'projects' => $data['projects'],
            ], '');
        }
    }
}