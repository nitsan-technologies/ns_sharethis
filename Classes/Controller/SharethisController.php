<?php
namespace NITSAN\NsSharethis\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

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
        if (! empty($extConf['csspath'])) {
            $cssFileName = ltrim($extConf['csspath'], '/');
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
            $userClass     = $extConf['class'] ?? 'sharethis-inline-share-buttons';

            if (! empty($userScriptUrl)) {
                // Inject ShareThis JS
                $pageRenderer->addHeaderData(
                    '<script type="text/javascript" src="' . htmlspecialchars($userScriptUrl) . '" async></script>'
                );

                // Inject share buttons container with configurable class
                $pageRenderer->addHeaderData('
            <!-- ShareThis BEGIN -->
            <div class="' . htmlspecialchars($userClass) . '"></div>
            <!-- ShareThis END -->
        ');
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
