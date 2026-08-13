<?php

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

ExtensionUtility::registerPlugin(
    'SiteTeam',
    'TeamList',
    'site_team.db:plugin.teamlist.title',
    'site-team-team-list',
    'plugins',
    'site_team.db:plugin.teamlist.description',
    'EXT:site_team/Configuration/FlexForms/TeamList.xml',
);