<?php 
defined('TYPO3_MODE') or die();

$_EXTKEY = 'ns_sharethis';

$configuration = isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['ns_sharethis']) ? unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['ns_sharethis']) : '';


if($configuration['globalSharing'] != '1' ){

	/***************
	 * Plugin
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
		'Nitsan.' . $_EXTKEY,
		'Nitsansharethis',
		'Nitsan Social Widget'
	   	);


	$pluginSignature = str_replace('_', '', $_EXTKEY).'_nitsansharethis';

	$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature,'FILE:EXT:'.$_EXTKEY.'/Configuration/FlexForms/flexform_socialwidget.xml');	

}
