<?php

declare(strict_types=1);

namespace JD\JdHeadlessApi\Mapper;

class TtContentMapper extends AbstractMapper implements MapperInterface
{
    public function map(array $data): array
    {
        if (empty($data)) {
            return [];
        }
        $mapConfig = $this->configurationLoader->loadConfiguration('ttContent');
    }
}
