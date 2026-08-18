<?php

declare(strict_types=1);

use Neon\TxTeam\Controller\MemberController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

ExtensionUtility::configurePlugin(
    'TxTeam',
    'TeamList',
    [
        MemberController::class => ['list', 'show', 'create'],
    ],
    [
        MemberController::class => ['create'],
    ]
);