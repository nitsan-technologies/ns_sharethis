<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

$_EXTKEY = 'ns_sharethis';

$configuration = $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['ns_sharethis'] ?? '';

/***************
 * Plugin
 */
$pluginSignature = ExtensionUtility::registerPlugin(
    $_EXTKEY,
    'Nitsansharethis',
    'Nitsan Sharethis (Social Widget)',
    'content-plugin',
    'plugins'

);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] =
    'pi_flexform';
ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_socialwidget10.xml'
);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] =
    'recursive,select_key,pages';
