<?php

declare(strict_types=1);

use Neon\TxTeam\Controller\AdminController;

return [
    'web_txteam' => [
        'parent' => 'web',
        'position' => ['after' => 'web_list'],
        'access' => 'user,group',
        'iconIdentifier' => 'module-team',
        'path' => '/module/web/txteam',
        'labels' => 'LLL:EXT:tx_team/Resources/Private/Language/locallang_mod.xlf',
        'extensionName' => 'TxTeam',
        'controllerActions' => [
            AdminController::class => [
                'index',
                'members',
                'departments',
                'deleteMember',
                'deleteDepartment',
            ],
        ],
    ],
];