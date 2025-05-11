<?php

declare(strict_types=1);

namespace JD\JdHeadlessApi\Services;

use Psr\Http\Message\RequestInterface;
use TYPO3\CMS\Core\Utility\ArrayUtility;

class ServerRequestService
{
    /**
     * This function extract data from the query parameter.
     *
     * @param string $queryPath
     */
    public function getQueryParameter(string $queryPath): mixed
    {
        if (empty($queryPath)) {
            return null;
        }

        $request = static::getServerRequest();
        if (empty($request)) {
            return null;
        }
        $queryParams = $request->getQueryParams();
        $data = ArrayUtility::getValueByPath($queryParams, $queryPath);

        return $data;
    }

    /**
     * Get the ServerRequest object from the globals.
     */
    public static function getServerRequest(): ?RequestInterface
    {
        return $GLOBALS['TYPO3_REQUEST'];
    }
}
