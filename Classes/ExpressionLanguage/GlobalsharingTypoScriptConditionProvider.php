<?php

declare(strict_types=1);

namespace NITSAN\NsSharethis\ExpressionLanguage;

use TYPO3\CMS\Core\ExpressionLanguage\AbstractProvider;

/**
 * Class GlobalsharingTypoScriptConditionProvider
 */
class GlobalsharingTypoScriptConditionProvider extends AbstractProvider
{
    /**
     * GlobalsharingConditionFunctionsProvider constructor.
     */
    public function __construct()
    {
        $this->expressionLanguageProviders = [
            GlobalsharingConditionFunctionsProvider::class,
        ];
    }
}