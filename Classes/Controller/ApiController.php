<?php

declare(strict_types=1);

namespace JD\JdHeadlessApi\Controller;

use JD\JdHeadlessApi\Domain\Repository\ApiRepository;
use JD\JdHeadlessApi\Mapper\MapperFactory;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ApiController extends ActionController
{

    public function __construct(
        private ApiRepository $apiRepository,
        private MapperFactory $mapperFactory
    ) {}

    public function getDataAction(array $payload): ResponseInterface
    {
        return $this->jsonResponse();
    }
}
