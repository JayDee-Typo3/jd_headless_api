<?php

declare(strict_types=1);

namespace JD\JdHeadlessApi\Mapper;

use JD\JdHeadlessApi\Services\Configuration\ConfigurationLoader;

abstract class AbstractMapper
{
    public function __construct(protected readonly ConfigurationLoader $configurationLoader) {}

    public function buildResponseArray(array $config, array $dataRows): array
    {
        $responseData = [
            'success' => true,
            'data' => []
        ];
        foreach ($dataRows as $row) {
            $responseData['data'][] = array_intersect_key($row, array_flip($config['fields']));
        }

        return $responseData;
    }
}
