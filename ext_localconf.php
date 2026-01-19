<?php

use NITSAN\NsSharethis\Controller\SharethisController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

if (!defined('TYPO3')) {
    die('Access denied.');
}

$_EXTKEY = 'ns_sharethis';

// @extensionScannerIgnoreLine
ExtensionUtility::configurePlugin(
    'NsSharethis',
    'Nitsansharethis',
    [
        SharethisController::class => 'list',
    ],
    // non-cacheble actions
    [
        SharethisController::class => 'list',
    ],
);