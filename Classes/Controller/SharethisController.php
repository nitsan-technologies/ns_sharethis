<?php
namespace NITSAN\NsSharethis\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2025
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
        $extConf       = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('ns_sharethis');
        $globalSharingEnabled = (isset($extConf['globalSharing']) && (int) $extConf['globalSharing'] === 1);
        if ($globalSharingEnabled) {
            $userScriptUrl = $extConf['url'] ?? '';
            $userClass     = $extConf['class'] ?? '';
            if (! empty($userScriptUrl)) {
                // Inject ShareThis JS
                $pageRenderer->addHeaderData($userScriptUrl);
                $pageRenderer->addHeaderData($userClass);
            }
        }
        $this->view->assignMultiple([
            'configuration' => $extConf,
        ]);
        return $this->htmlResponse();
    }

 
}
