<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}
$_EXTKEY = 'ns_sharethis';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Nitsan.' . $_EXTKEY,
    'Nitsansharethis',
    [
        'Sharethis' => 'list',
        ],
    // non-cacheble actions
    [
        'Sharethis' => 'list',
        ]
);
