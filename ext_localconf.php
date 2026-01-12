<?php

use NITSAN\NsSharethis\Controller\SharethisController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;

if (!defined('TYPO3')) {
    die('Access denied.');
}

$_EXTKEY = 'ns_sharethis';

$versionNumber =  VersionNumberUtility::convertVersionStringToArray(VersionNumberUtility::getCurrentTypo3Version());

if ($versionNumber['version_main'] <= 12) {
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
} else {
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
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
    );
}
