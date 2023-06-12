<?php
if (!defined('TYPO3')) {
    die('Access denied.');
}

$configuration = isset($GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['ns_sharethis']) ? $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['ns_sharethis'] : '';

if (!isset($configuration['globalSharing']) or (isset($configuration['globalSharing']) and $configuration['globalSharing'] != 1)) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:ns_sharethis/Configuration/TSconfig/ContentElementWizard.tsconfig">'
    );
}
