<?php
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
