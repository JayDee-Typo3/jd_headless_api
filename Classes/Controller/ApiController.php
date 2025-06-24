<?php

declare(strict_types=1);

namespace JD\JdHeadlessApi\Controller;

use InvalidArgumentException;
use JD\JdHeadlessApi\Domain\Repository\ApiRepository;
use JD\JdHeadlessApi\Mapper\MapperFactory;
use JD\JdHeadlessApi\Traits\ApiTrait;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * The API action controller.
 *
 * @package JD\JdHeadlessApi\Controller
 */
class ApiController extends ActionController
{
    use ApiTrait;

    /**
     * The index controller action
     *
     * @return ResponseInterface
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function indexAction(): ResponseInterface
    {
        $arguments = $this->request->getArguments();
        if (empty($arguments['payload'])) {
            return $this->jsonResponse($this->getEmptyJsonResponse());
        }
        $action = ArrayUtility::getValueByPath($arguments, 'payload/action');
        switch ($action) {
            default:
                return $this->jsonResponse($this->getEmptyJsonResponse());
        }
        return $this->jsonResponse($this->getEmptyJsonResponse());
    }
}
