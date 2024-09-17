<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') || die('Access denied.');

$_EXTKEY = 'ns_sharethis';

// Adding fields to the tt_content table definition in TCA
ExtensionManagementUtility::addStaticFile(
    $_EXTKEY,
    'Configuration/TypoScript',
    'Sharethis'
);