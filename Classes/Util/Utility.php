<?php

namespace Nitsan\NsSharethis\Util;
/**
 * Description of Utility
 *
 * @author SEVER26
 */
class Utility
{
    const ALLOWED_SOCIALS = array(
    "blogger",
    "delicious",
    "digg",
    "email",
    "facebook",
    "flipboard",
    "googleplus",
    "linkedin",
    "livejournal",
    "mailru",
    "meneame",
    "odnoklassniki",
    "pinterest",
    "print",
    "reddit",
    "sharethis",
    "sms",
    "stumbleupon",
    "tumblr",
    "twitter",
    "vk",
    "weibo",
    "whatsapp",
    "xing");
    
    private function __construct(){
        
    }
    
    
    /**
     * 
     * @return string $html 
     */
    
    public static function getPublicJsRessourcesHtmlTags(){
        $ressources = '<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5b80184e0fb29d0011a67f61&product=custom-share-buttons" async="async"></script>'; 
        
        return $ressources;
    }
}
