<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/7/31 0031
 * Time: 14:48
 */
namespace Helper;

use SyTool\SyPack;
use SyTool\Tool;

class DbCheck
{
    /**
     * @var string
     */
    private $sendContent = '';

    public function __construct()
    {
        $syPack = new SyPack();
        $syPack->setCommandAndData(SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_API_REQ, [
            'api_uri' => '/Index/Index/check',
            'api_params' => [],
        ]);
        $this->sendContent = $syPack->packData();
        unset($syPack);
    }

    private function __clone()
    {
    }

    public function check(array $projects)
    {
        foreach ($projects as $eProject) {
            if ($eProject['module_type'] == 'rpc') {
                foreach ($eProject['listens'] as $eListen) {
                    Tool::sendSyRpcReq($eListen['host'], $eListen['port'], $this->sendContent);
                }
            }
        }
    }
}
