<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:ns_sharethis/Configuration/TSconfig/ContentElementWizard.tsconfig">'
);

$configuration = isset($GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['ns_sharethis']) ? $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['ns_sharethis'] : '';
if (isset($configuration['globalSharing']) and $configuration['globalSharing'] == 1) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript('ns_sharethis','setup',
        'page.1717079746 >
        page.1717079746 = USER
        page.1717079746{
            userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
            pluginName = Nitsansharethis
            extensionName = NsSharethis
            controller = Sharethis
            vendorName = NITSAN
            action = list
            switchableControllerActions{
                Sharethis{
                    1 = list
                }
            }
        }'
    );
}
