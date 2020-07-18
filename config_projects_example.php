<?php
$serverHost = \Yaconf::get('syserver.base.server.host');

return [
    0 => [
        'git_branch' => 'master',
        'module_type' => 'api',
        'module_path' => 'sy_api',
        'module_name' => 'm01api',
        'listens' => [
            0 => [
                'host' => $serverHost,
                'port' => 7100,
                'register_type' => 'nginx',
                'ng_weight' => 1,
                'ng_max_fails' => 3,
                'ng_fail_timeout' => 30,
                'ng_backup' => 0,
            ],
        ],
    ],
];
