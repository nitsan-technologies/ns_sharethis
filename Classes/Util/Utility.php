<?php

namespace Nitsan\NsSharethis\Util;
/**
 * Description of Utility
 *
 * @author SEVER26
 */
class Utility
{
    private function __construct(){
        
    }
    
    /**
     * 
     * @return boolean
     */
    public static function isHttps() {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";
        
        $proxyIsHttps = false;
        $proxySSL = trim($GLOBALS['TYPO3_CONF_VARS']['SYS']['reverseProxySSL']);
        if ($proxySSL === '*') {
            $proxySSL = $GLOBALS['TYPO3_CONF_VARS']['SYS']['reverseProxyIP'];
        }
        if (\TYPO3\CMS\Core\Utility\GeneralUtility::cmpIP($_SERVER['REMOTE_ADDR'], $proxySSL)) {
            $proxyIsHttps = true;
        }
        
        return $proxyIsHttps OR $protocol == 'https';
    }
    
    /**
     * 
     * @return string $html 
     */
    
    public static function getPublicRessourcesHtmlTags(){
        if(self::isHttps()){
            $button_JS = 'https://ws.sharethis.com/button/buttons.js';
            $loader_JS = 'https://ss.sharethis.com/loader.js';
        }
        else{
            $button_JS = 'http://w.sharethis.com/button/buttons.js';
            $loader_JS = 'http://s.sharethis.com/loader.js';
        }
        
        $ressources = '<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js" async="async"></script>
            <script type="text/javascript">
                var switchTo5x= true ;
            </script>
            <script type="text/javascript" id="st_insights_js" src="'.$button_JS.'"></script>
            <script type="text/javascript" src="'.$loader_JS.'"></script>
        '; 
        
        return $ressources;
    }
}
