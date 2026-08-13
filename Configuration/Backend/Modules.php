<?php

use Neon\SiteTeam\Controller\TeamController;

return [
    'site_team_team' => [
        'parent' => 'web',
        'position' => ['after' => '*'],
        'access' => 'user',
        'path' => '/module/web/site-team-team',
        'iconIdentifier' => 'site-team-team-module',
        'labels' => 'site_team.modules.team',
        'extensionName' => 'SiteTeam',
        'controllerActions' => [
            TeamController::class => [
                'index', 'show', 'new', 'create', 'edit', 'update', 'delete',
            ],
        ],
    ],
];