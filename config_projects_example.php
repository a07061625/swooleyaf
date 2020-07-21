<?php
$serverHost = \Yaconf::get('syserver.base.server.host');

return [
    0 => [
        'git_branch' => 'master',
        'module_type' => 'api',
        'module_path' => 'sy_api',
        'module_name' => 'a01api',
        'listens' => [
            0 => [
                'host' => $serverHost,
                'port' => 7100,
                'register_type' => 'nginx',
            ],
        ],
    ],
    1 => [
        'git_branch' => 'master',
        'module_type' => 'rpc',
        'module_path' => 'sy_order',
        'module_name' => 'a01order',
        'listens' => [
            0 => [
                'host' => $serverHost,
                'port' => 7120,
            ],
        ],
    ],
    2 => [
        'git_branch' => 'master',
        'module_type' => 'rpc',
        'module_path' => 'sy_user',
        'module_name' => 'a01user',
        'listens' => [
            0 => [
                'host' => $serverHost,
                'port' => 7140,
            ],
        ],
    ],
    3 => [
        'git_branch' => 'master',
        'module_type' => 'rpc',
        'module_path' => 'sy_services',
        'module_name' => 'a01services',
        'listens' => [
            0 => [
                'host' => $serverHost,
                'port' => 7160,
            ],
        ],
    ],
    4 => [
        'git_branch' => 'master',
        'module_type' => 'rpc',
        'module_path' => 'sy_content',
        'module_name' => 'a01content',
        'listens' => [
            0 => [
                'host' => $serverHost,
                'port' => 7180,
            ],
        ],
    ],
];
