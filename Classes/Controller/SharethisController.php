<?php
namespace Nitsan\NsSharethis\Controller;

use Nitsan\NsSharethis\Util\Utility;

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

use TYPO3\CMS\Extbase\Utility\DebuggerUtility as Debug;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Page\PageRenderer;

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
        $css = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::siteRelPath('ns_sharethis') . 'Resources/Public/Css/custom.css';
        $pageRenderer->addCssFile($css, $rel = 'stylesheet', $media = 'all', $compress = true, $forceOnTop = false);
        
        $configuration = isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['ns_sharethis']) ? unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['ns_sharethis']) : '';

        $settings = $this->settings;
        
        $pageRenderer->addHeaderData(Utility::getPublicJsRessourcesHtmlTags());
        
        if($settings['socials'] === ''){
            $settings['socials'] = $configuration['items'];
        }
        $socials = str_replace('"', "", $settings['socials']);
        $socials = str_replace(" ", "", $socials);
        $socials = explode(',',$socials);
        foreach($socials as $index => $social){
            if(!in_array($social, Utility::ALLOWED_SOCIALS)){
                unset($socials[$index]);
            }
        }

        $this->view->assign('socials',$socials); 
        $this->view->assign('configuration' ,$configuration);           
    }
}
		

		