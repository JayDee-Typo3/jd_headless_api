<?php

declare(strict_types=1);

namespace JD\JdHeadlessApi\Events;

/**
 * A event to modify the default yaml configuration.
 *
 * @package JD\JdHeadlessApi\Events
 */
final class ModifyYamlConfigurationPathEvent
{
    /**
     * Event constructor.
     *
     * @param string $yamlPath
     * @param string $configIdentifier
     */
    public function __construct(private string $yamlPath, private readonly string $configIdentifier) {}

    /**
     * Returns the wholePath
     */
    public function getYamlPath(): string
    {
        return $this->yamlPath;
    }

    /**
     * Set the wholePath after modification.
     *
     * @param string $yamlPath
     */
    public function setYamlPath(string $yamlPath): void
    {
        $this->yamlPath = $yamlPath;
    }

    /**
     * Returns the readonly configIdentifier
     */
    public function getConfigIdentifier(): string
    {
        return $this->configIdentifier;
    }
}
