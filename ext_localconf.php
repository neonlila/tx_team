<?php

use Neon\SiteTeam\Controller\TeamController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

ExtensionUtility::configurePlugin(
    'SiteTam',
    'TeamList',
    [TeamController::class => 'list, show, create'],
    [TeamController::class => 'create'],
);