<?php

declare(strict_types=1);

namespace JD\JdHeadlessApi\Mapper;

interface MapperInterface
{
    public function map(array $data): array;
}
