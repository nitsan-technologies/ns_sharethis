<?php

declare(strict_types=1);

namespace NITSAN\NsSharethis\ExpressionLanguage;


use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class GlobalsharingConditionFunctionsProvider implements ExpressionFunctionProviderInterface
{

        public function getFunctions(): array
    {
        return [
            $this->getWebserviceFunction(),
        ];
    }

protected function getWebserviceFunction(): ExpressionFunction
{
    return new ExpressionFunction(
        'globalSharing',
        
        function () {
        },
        function () {
            $extConf = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('ns_sharethis');
            return !empty($extConf['globalSharing']) && (int)$extConf['globalSharing'] === 1;
        }
    );
}
}



