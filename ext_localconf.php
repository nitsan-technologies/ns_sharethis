<?php

use NITSAN\NsSharethis\Controller\SharethisController;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

if (!defined('TYPO3')) {
    die('Access denied.');
}

$_EXTKEY = 'ns_sharethis';

ExtensionUtility::configurePlugin(
    'NsSharethis',
    'Nitsansharethis',
    [
        SharethisController::class => 'list',
    ],
    // non-cacheble actions
    [
        SharethisController::class => 'list',
    ]
);
//register icon
$iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);
$iconRegistry->registerIcon(
    'sharethis-content-plugin',
    SvgIconProvider::class,
    ['source' => 'EXT:ns_sharethis/Resources/Public/Icons/Extension.svg']
);
