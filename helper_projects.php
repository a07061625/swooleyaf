<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-7-1
 * Time: 下午3:49
 */
$serverHost = \Yaconf::get('syserver.base.server.host');

return [
    0 => [
        'git_branch' => 'master',
        'module_type' => 'api',
        'module_path' => 'sy_api',
        'module_name' => 'z01api',
        'listens' => [
            0 => [
                'host' => $serverHost,
                'port' => 7100,
            ],
        ],
    ],
];