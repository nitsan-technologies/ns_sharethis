<?php
namespace Nitsan\NsSharethis\TypoScript;

/**
 * CheckGlobal condition
 */
class CheckGlobal extends \TYPO3\CMS\Core\Configuration\TypoScript\ConditionMatching\AbstractCondition
{

    /**
     * Evaluate condition
     *
     * @param array $conditionParameters
     * @return bool
     */
    public function matchCondition(array $conditionParameters)
    {
        $configuration = isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['ns_sharethis']) ? unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['ns_sharethis']) : '';

        if (isset($configuration['globalSharing']) and $configuration['globalSharing'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}
