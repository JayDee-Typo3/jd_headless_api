<?php

declare(strict_types=1);

namespace JD\JdHeadlessApi\Mapper;

use JD\JdHeadlessApi\Events\MapperRegistrationEvent;
use TYPO3\CMS\Core\EventDispatcher\EventDispatcher;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This Factory generate instances of mapper classes.
 */
class MapperFactory
{
    /**
     * This map array maps the mapper class on domain.
     * [
     *      'TtContent' => \JD\JdHeadlessApi\Mapper\TtContentMapper::class,
     *      'News' => \JD\JdHeadlessApi\Mapper\NewsMapper::class,
     *      ...
     * ]
     * By subscribing the MapperRegistrationEvent you can extend this list by your own
     * mapper.
     *
     * @var array $mapperClasses
     */
    protected array $mapperClasses = [];

    /**
     * This is the default Factory constructor.
     *
     * @param EventDispatcher $eventDispatcher
     */
    public function __construct(EventDispatcher $eventDispatcher)
    {
        $event = new MapperRegistrationEvent($this->mapperClasses);
        $eventDispatcher->dispatch($event);

        $this->mapperClasses = $event->getMapperClassesArray();
    }

    /**
     * This function returns an instance of the mapper to the given domain if it exists or null if not.
     *
     * @var string $domainName
     */
    public function getMapper(string $domainName): ?object
    {
        if (!empty($this->mapperClasses[$domainName])) {
            return GeneralUtility::makeInstance($this->mapperClasses[$domainName]);
        }

        return null;
    }
}
