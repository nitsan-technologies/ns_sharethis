<?php

use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}
// $_EXTKEY = 'ns_sharethis';

if (version_compare(TYPO3_branch, '10.0', '>=')) {
    $moduleClass = \Nitsan\NsSharethis\Controller\SharethisController::class;
} else {
    $moduleClass = 'Sharethis';
}
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Nitsan.NsSharethis',
    'Nitsansharethis',
    [
        $moduleClass => 'list',
    ],
    // non-cacheble actions
    [
        $moduleClass => 'list',
    ]
);

$iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);
$iconRegistry->registerIcon(
    'sharethis-content-plugin',
    SvgIconProvider::class,
    ['source' => 'EXT:ns_sharethis/Resources/Public/Icons/Extension.svg']
);