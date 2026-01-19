<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;

defined('TYPO3') or die();

$_EXTKEY = 'ns_sharethis';

$configuration = $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['ns_sharethis'] ?? '';
/***************
 * Plugin
 */
$versionNumber =  VersionNumberUtility::convertVersionStringToArray(VersionNumberUtility::getCurrentTypo3Version());
if ($versionNumber['version_main'] >= 14) {
    ExtensionUtility::registerPlugin(
        $_EXTKEY,
        'Nitsansharethis',
        'Sharethis (Social Widget)',
        'sharethis-content-plugin',
        'plugins',
        '',
        'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_socialwidget10.xml'
    );
} else {
    $pluginSignature = ExtensionUtility::registerPlugin(
        $_EXTKEY,
        'Nitsansharethis',
        'Sharethis (Social Widget)',
        'sharethis-content-plugin',
        'plugins'
    );

    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key,pages';

    // @extensionScannerIgnoreLine
    ExtensionManagementUtility::addPiFlexFormValue(
        $pluginSignature,
        'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_socialwidget10.xml'
    );
}
