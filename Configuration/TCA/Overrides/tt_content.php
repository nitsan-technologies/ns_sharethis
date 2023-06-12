<?php
defined('TYPO3') or die();

$_EXTKEY = 'ns_sharethis';

$configuration = isset($GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['ns_sharethis']) ? $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['ns_sharethis'] : '';

if (!isset($configuration['globalSharing']) or (isset($configuration['globalSharing']) and $configuration['globalSharing'] != 1)) {

    /***************
     * Plugin
     */
    $pluginSignature = \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        $_EXTKEY,
        'Nitsansharethis',
        'Nitsan Sharethis (Social Widget)'
    );

    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_socialwidget10.xml');
    
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key,pages';
}
