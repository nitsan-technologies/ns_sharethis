<?php
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
if (!defined('TYPO3')) {
    die('Access denied.');
}

$configuration = isset($GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['ns_sharethis']) ? $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['ns_sharethis'] : '';

if (isset($configuration['globalSharing']) and $configuration['globalSharing'] == 1) {
    ExtensionManagementUtility::addTypoScript('ns_sharethis','setup',
        '
        page.111245 >
        page.111245 = USER
        page.111245{
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
            view =< plugin.tx_nssharethis.view  
        }
        '
    );
}
