<?php
namespace NITSAN\NsSharethis\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2023
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

class SharethisController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * List action
     *
     * @return ResponseInterface
     */
    public function listAction(): ResponseInterface
    {
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);

        $extConf = $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['ns_sharethis'] ?? [];
        if (! empty($extConf['cssPath'])) {
            $cssFileName = ltrim($extConf['cssPath'], '/');
            $assetPath   = Environment::isComposerMode()
                ? $this->getPath('/', 'ns_sharethis')
                : PathUtility::stripPathSitePrefix(ExtensionManagementUtility::extPath('ns_sharethis')) . 'Resources/Public/';
            $cssFile = $assetPath . $cssFileName;
            $pageRenderer->addCssFile($cssFile, 'stylesheet', 'all', true, false);
        }

        // Extension configuration
        $extConf       = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('ns_sharethis');
        $configuration = $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['ns_sharethis'] ?? [];
        $settings      = $this->settings;

        // Determine protocol (https/http)
        $protocol     = (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http';
        $proxyIsHttps = false;
        $proxySSL     = trim($GLOBALS['TYPO3_CONF_VARS']['SYS']['reverseProxySSL']);
        if ($proxySSL === '*') {
            $proxySSL = $GLOBALS['TYPO3_CONF_VARS']['SYS']['reverseProxyIP'];
        }
        if (GeneralUtility::cmpIP($_SERVER['REMOTE_ADDR'], $proxySSL)) {
            $proxyIsHttps = true;
        }

        $globalSharingEnabled = (isset($configuration['globalSharing']) && (int) $configuration['globalSharing'] === 1);
        $categoryHoverBar     = (isset($settings['categories']) && $settings['categories'] === 'hoverBar');

        if ($categoryHoverBar || $globalSharingEnabled) {
            $userScriptUrl = $extConf['url'] ?? '';
            $userClass     = $extConf['class'] ?? '';

            if (! empty($userScriptUrl)) {
                // Inject ShareThis JS
                $pageRenderer->addHeaderData($userScriptUrl);
                $pageRenderer->addHeaderData($userClass);
            }
        }

        // Social items (optional for Fluid)
        $socials = explode(',', str_replace(['"', ' '], '', $configuration['items'] ?? ''));
        $this->view->assignMultiple([
            'socials'       => $socials,
            'configuration' => $configuration,
        ]);

        return $this->htmlResponse();
    }

    /**
     * Get path for composer-based setup
     *
     * @param string $path
     * @param string $extName
     * @return string
     */
    protected function getPath(string $path, string $extName): string
    {
        $publicPath = sprintf('EXT:%s/Resources/Public/%s', $extName, ltrim($path, '/'));
        $uri        = PathUtility::getPublicResourceWebPath($publicPath);
        return substr($uri, 1);
    }
}
