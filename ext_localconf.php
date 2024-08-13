<?php

use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
if (!defined('TYPO3')) {
    die('Access denied.');
}

$_EXTKEY = 'ns_sharethis';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'NsSharethis',
    'Nitsansharethis',
    [
        \NITSAN\NsSharethis\Controller\SharethisController::class => 'list',
    ],
    // non-cacheble actions
    [
        \NITSAN\NsSharethis\Controller\SharethisController::class => 'list',
    ]
);
//register icon
$iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);
$iconRegistry->registerIcon(
    'sharethis-content-plugin',
    SvgIconProvider::class,
    ['source' => 'EXT:ns_sharethis/Resources/Public/Icons/Extension.svg']
);
