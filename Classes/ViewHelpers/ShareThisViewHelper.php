<?php

namespace Nitsan\NsSharethis\ViewHelpers;

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
    
    /**
	 * Initialize arguments
	 *
	 * @return void
	 * @api
	 */
	public function initializeArguments() {
		$this->registerUniversalTagAttributes();
	}
    
    public function render() {
        
        $settings = array(
            'categories' => 'simpleWidget',
            'buttonType' => 'horizontal',
        );
        $socials = explode(',','facebook,twitter');
        
        $data = array(
            'configuration' => array('globalSharing' => 0),
            'settings' => $settings,
            'socials' => $socials,
        );
        
        
        $view = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
        $view->setTemplatePathAndFilename('EXT:ns_sharethis/Resources/Private/Partials/ShareButtons.html');
        $view->assignMultiple($data);
        
        $content = $view->render();
        
        return $content;
    }
}
