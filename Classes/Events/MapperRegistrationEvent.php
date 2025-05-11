<?php

declare(strict_types=1);

namespace JD\JdHeadlessApi\Events;

final class MapperRegistrationEvent
{
    public function __construct(public array $mapperClassesArray) {}

    public function getMapperClassesArray(): array
    {
        return $this->mapperClassesArray;
    }

    public function setMapperClassesArray(array $overrideMappClassesArray): void
    {
        $this->mapperClassesArray = $overrideMappClassesArray;
    }

    public function addMapperToList(string $domain, string $class): void
    {
        $this->mapperClassesArray[$domain] = $class;
    }

    public function removeMapperFromList(string $domain): void
    {
        if (!empty($this->mapperClassesArray[$domain])) {
            unset($this->mapperClassesArray[$domain]);
        }
    }
}
