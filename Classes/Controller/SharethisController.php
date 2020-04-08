<?php
namespace Nitsan\NsSharethis\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * SharethisController
 */
class SharethisController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        // Ouput text to user based on test
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        if (version_compare(TYPO3_branch, '9.0', '>')) {
            $css = \TYPO3\CMS\Core\Utility\PathUtility::stripPathSitePrefix(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('ns_sharethis')) . 'Resources/Public/Css/custom.css';
        } else {
            $css = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::siteRelPath('ns_sharethis') . 'Resources/Public/Css/custom.css';
        }

        $pageRenderer->addCssFile($css, $rel = 'stylesheet', $media = 'all', $compress = true, $forceOnTop = false);

        if (version_compare(TYPO3_branch, '10.0', '>=')) {
            $configuration = $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['ns_sharethis'];
        } else {
            $configuration = isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['ns_sharethis']) ? unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['ns_sharethis']) : '';
        }

        $settings = $this->settings;

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https' : 'http';

        $proxyIsHttps = false;
        $proxySSL = trim($GLOBALS['TYPO3_CONF_VARS']['SYS']['reverseProxySSL']);
        if ($proxySSL === '*') {
            $proxySSL = $GLOBALS['TYPO3_CONF_VARS']['SYS']['reverseProxyIP'];
        }
        if (\TYPO3\CMS\Core\Utility\GeneralUtility::cmpIP($_SERVER['REMOTE_ADDR'], $proxySSL)) {
            $proxyIsHttps = true;
        }

        if ($proxyIsHttps or $protocol == 'https') {
            $button_JS = 'https://ws.sharethis.com/button/buttons.js';
            $loader_JS = 'https://ss.sharethis.com/loader.js';
        } else {
            $button_JS = 'http://w.sharethis.com/button/buttons.js';
            $loader_JS = 'http://s.sharethis.com/loader.js';
        }

        $main_script = '"position": "' . $configuration['position'] . '"';

        $chicklets = ' "chicklets":{"items":[' . $configuration['items'] . ']}';
        $script = '' . $main_script . ',' . $chicklets . ' ';

        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addHeaderData('
            <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js" async="async"></script>
            <script type="text/javascript">
                var switchTo5x= true ;
            </script>
            <script type="text/javascript" id="st_insights_js" src="' . $button_JS . '"></script>
            <script type="text/javascript" src="' . $loader_JS . '"></script>
            ');

        if ((isset($settings['categories']) and $settings['categories']=='hoverBar') || (isset($configuration['globalSharing']) and $configuration['globalSharing']==1)) {
            if ($configuration['position']=='bottom') {
                $pageRenderer->addFooterData('
                <script>
                    var options={' . $script . '};
                    var st_bar_widget = new sharethis.widgets.sharebar(options);
                </script> ');
            } elseif ($configuration['position']=='top') {
                $pageRenderer->addFooterData('
                <script>
                    var options={' . $script . '};
                    var st_pulldown_widget = new sharethis.widgets.pulldownbar(options);
                </script> ');
            } else {
                $pageRenderer->addFooterData('
                <script>
                    var options={' . $script . '};
                    var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
                </script>
                ');
            }
        }

        $social= str_replace('"', '', $configuration['items']);
        $social = str_replace(' ', '', $social);
        $social = explode(',', $social);

        $this->view->assign('socials', $social);
        $this->view->assign('configuration', $configuration);
    }
}
