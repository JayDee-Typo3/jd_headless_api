<?php

declare(strict_types=1);

namespace JD\JdHeadlessApi\Services\TypoScript;

use TYPO3\CMS\Core\TypoScript\TypoScriptService;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

class ReaderService
{
    /**
     * Service constructor.
     *
     * @param TypoScriptService $typoScriptService
     * @param ConfigurationManager $configurationManager
     */
    public function __construct(
        private TypoScriptService $typoScriptService,
        private ConfigurationManager $configurationManager
    ) {}

    /**
     * This function extract an array out of the typoscript by given path.
     *
     * @param string $typoScriptPath
     */
    public function getTypoScriptConfiguration(string $typoScriptPath): array
    {
        if (empty($typoScriptPath)) {
            return [];
        }

        $typoScript = $this->typoScriptService->convertTypoScriptArrayToPlainArray(
            $this->configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT)
        );

        $configuration = ArrayUtility::getValueByPath($typoScript, $typoScriptPath);

        if ($configuration === null) {
            return [];
        }

        return $configuration;
    }
}
