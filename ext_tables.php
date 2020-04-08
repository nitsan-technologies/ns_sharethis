<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$configuration = isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['ns_sharethis']) ? unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['ns_sharethis']) : '';

if (!isset($configuration['globalSharing']) or (isset($configuration['globalSharing']) and $configuration['globalSharing'] != 1)) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:ns_sharethis/Configuration/TSconfig/ContentElementWizard.txt">'
    );
}
