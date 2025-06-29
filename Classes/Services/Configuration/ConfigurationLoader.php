<?php

declare(strict_types=1);

namespace JD\JdHeadlessApi\Services\Configuration;

use JD\JdHeadlessApi\Events\ModifyYamlConfigurationPathEvent;
use JD\JdHeadlessApi\Services\TypoScript\ReaderService;
use TYPO3\CMS\Core\Configuration\Loader\YamlFileLoader;
use TYPO3\CMS\Core\EventDispatcher\EventDispatcher;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ConfigurationLoader
{
    /**
     * YamlFileLoader
     *
     * @var YamlFileLoader $yamlFileLoader
     */
    protected ?YamlFileLoader $yamlFileLoader;

    /**
     * @var string $typoScriptElementsPath
     */
    private string $typoScriptElementsPath = 'plugin/tx_jdheadless_api/configuration/elements';

    /**
     * Service constructor
     *
     * @param ReaderService $typoScriptReaderService
     * @param EventDispatcher $eventDispatcher
     */
    public function __construct(
        private ReaderService $typoScriptReaderService,
        private EventDispatcher $eventDispatcher
    ) {
        $this->yamlFileLoader = GeneralUtility::makeInstance(YamlFileLoader::class);
    }

    /**
     * This function use the YamlFileLoader class to load the configured yaml configurationin
     * from the plugin.tx_jdheadless_api.configuration/mapper/ typoscript.
     *
     * If you want to load yaml configuration from an other extension source subscribe
     * ModifyYamlConfigurationPathEvent and feel free to modify the path. :)
     *
     * @param string $configIndentifier
     */
    public function loadConfiguration(string $configIndentifier): array
    {
        if (empty($configIndentifier)) {
            return [];
        }

        $typoScriptConfig = $this->typoScriptReaderService->getTypoScriptConfiguration($this->typoScriptElementsPath);
        $yamlPath = $typoScriptConfig[$configIndentifier] ?? '';

        $event = new ModifyYamlConfigurationPathEvent($yamlPath, $configIndentifier);
        $this->eventDispatcher->dispatch($event);
        $yamlPath = $event->getYamlPath();

        if (!file_exists(GeneralUtility::getFileAbsFileName($yamlPath))) {
            return [];
        }

        return $this->yamlFileLoader->load($yamlPath);
    }
}
