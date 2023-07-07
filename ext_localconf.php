<?php

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
