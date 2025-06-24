<?php

declare(strict_types=1);

namespace JD\JdHeadlessApi\Traits;

trait ApiTrait
{
    /**
     * Default response json structure.
     *
     * @var array $emptyReturn
     */
    public array $emptyReturn = [
        'pagination' => [
            'curPage' => 0,
            'maxPagesCoutn' => 0,
            'nextPageUri' => '',
            'prevPageUri' => ''
        ],
        'data' => [],
        'included' => []
    ];

    /**
     * Return a empty response structure.
     */
    public function getEmptyJsonResponse(): string
    {
        return json_encode($this->emptyReturn);
    }
}
