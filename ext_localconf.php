<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

$_EXTKEY = 'ns_sharethis';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'NsSharethis',
    'Nitsansharethis',
    [
        \Nitsan\NsSharethis\Controller\SharethisController::class => 'list',
    ],
    // non-cacheble actions
    [
        \Nitsan\NsSharethis\Controller\SharethisController::class => 'list',
    ]
);
