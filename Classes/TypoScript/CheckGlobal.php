<?php
namespace Nitsan\NsSharethis\TypoScript;

/**
 * CheckGlobal condition
 */
class CheckGlobal extends \TYPO3\CMS\Core\Configuration\TypoScript\ConditionMatching\AbstractConditionMatcher
{

    /**
     * Evaluate condition
     *
     * @param array $conditionParameters
     * @return bool
     */
    public function matchCondition(array $conditionParameters)
    {
        $configuration = isset($GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['ns_sharethis']) ? $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['ns_sharethis'] : '';

        if (isset($configuration['globalSharing']) and $configuration['globalSharing'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}
