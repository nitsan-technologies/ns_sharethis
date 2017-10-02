<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Nitsan.' .$_EXTKEY,
	'Nitsansharethis',
	array(
		'Sharethis' => 'list',
		),
	// non-cacheble actions
	array(
		'Sharethis' => 'list',
		)
	);



