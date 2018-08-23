<?php

namespace Nitsan\NsSharethis\ViewHelpers;

use Nitsan\NsSharethis\Util\Utility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Page\PageRenderer;

/**
 * Description of ShareThisViewHelper
 *
 * @author SEVER26
 */
class ShareThisViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper 
{
    /**
     * @var boolean
     */
    protected $escapeOutput = false;
    
    const ALLOWED_SOCIALS = array("facebook","twitter","linkedin","pinterest","email","sharethis");
    const ALLOWED_BUTTON_TYPE = array("largeButton","smallButton","horizontal","vertical");
   
    /**
	 * Initialize arguments
	 *
	 * @return void
	 * @api
	 */
	public function initializeArguments() {
	}
    /**
     * 
     * @param string $buttonType
     * @param string $socials
     * @param string $url
     * @return string htmlContent
     */
    public function render($buttonType="horizontal",$socials,$url="") {
        
        $socials = explode(',',$socials);
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->settings);
        foreach($socials as $index => $social){
            if(!in_array($social,self::ALLOWED_SOCIALS)){
                unset($socials[$index]);
            }
        }
        if(!in_array($buttonType,self::ALLOWED_BUTTON_TYPE)){
            //TODO use translate
            $content = "invalid button type";
        }
        elseif(!is_array($socials) OR (is_array($socials) AND count($socials) === 0)){
            //TODO use translate
            $content = "invalid socials";
        }
        else{
            $settings = array(
                'buttonType' => $buttonType,
                'title' => $title,
                'url' => $url,
                'image' => $image,
                'summary' => $summary
            );

            $data = array(
                'settings' => $settings,
                'socials' => $socials,
            );

            $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
            $css = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::siteRelPath('ns_sharethis') . 'Resources/Public/Css/custom.css';
            $pageRenderer->addCssFile($css, $rel = 'stylesheet', $media = 'all', $compress = true, $forceOnTop = false);
            $pageRenderer->addHeaderData(Utility::getPublicRessourcesHtmlTags());

            $view = GeneralUtility::makeInstance('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
            $view->setTemplatePathAndFilename('EXT:ns_sharethis/Resources/Private/Partials/ShareButtons.html');
            $view->assignMultiple($data);

            $content = $view->render();
        }
        

        return $content;
    }
}
