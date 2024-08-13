<?php
defined('TYPO3_MODE') or die();

$_EXTKEY = 'ns_sharethis';

/***************
 * Plugin
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Nitsan.' . $_EXTKEY,
    'Nitsansharethis',
    'Sharethis (Social Widget)'
);

$pluginSignature = str_replace('_', '', $_EXTKEY) . '_nitsansharethis';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
if (version_compare(TYPO3_branch, '9.0', '>')) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
        $pluginSignature,
        'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_socialwidget10.xml'
    );
} else {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
        $pluginSignature,
        'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_socialwidget.xml'
    );
}
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key,pages';
