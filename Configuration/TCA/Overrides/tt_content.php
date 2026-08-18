<?php

declare(strict_types=1);

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

ExtensionUtility::registerPlugin(
    'TxTeam',
    'TeamList',
    'Team Directory List', 
    'EXT:core/Resources/Public/Icons/T3Icons/svgs/content/content-plugin.svg'
);