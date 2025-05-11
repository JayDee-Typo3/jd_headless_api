<?php

declare(strict_types=1);

namespace JD\JdHeadlessApi\Events;

final class ModifyYamlConfigurationPathEvent
{
    /**
     * Event constructor.
     *
     * @param string $wholePath
     * @param string $configIdentifier
     */
    public function __construct(private string $wholePath, private readonly string $configIdentifier) {}

    /**
     * Returns the wholePath
     */
    public function getWholePath(): string
    {
        return $this->wholePath;
    }

    /**
     * Set the wholePath after modification.
     *
     * @param string $wholePath
     */
    public function setWholePath(string $wholePath): void
    {
        $this->wholePath = $wholePath;
    }

    /**
     * Returns the readonly configIdentifier
     */
    public function getConfigIdentifier(): string
    {
        return $this->configIdentifier;
    }
}
