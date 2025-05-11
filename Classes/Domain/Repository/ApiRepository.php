<?php

declare(strict_types=1);

namespace JD\JdHeadlessApi\Domain\Repository;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Extbase\Persistence\Repository;

class ApiRepository extends Repository
{
    public function __construct(protected ConnectionPool $connectionPool) {}

    public function getDataByUid(string $tableName, int $uid): array
    {
        $queryBuilder = $this->connectionPool->getQueryBuilderForTable($tableName);
        $result = $queryBuilder->select('*')
            ->from($tableName)
            ->andWhere(
                $queryBuilder->expr()->eq(
                    'uid',
                    $queryBuilder->createNamedParameter($uid, Connection::PARAM_INT)
                )
            )
            ->executeQuery()
            ->fetchAssociative();

        if (is_bool($result)) {
            return [];
        }

        return $result;
    }

    public function getDataByIdentifier(string $tableName, string $fieldName, mixed $value): array
    {
        $queryBuilder = $this->connectionPool->getQueryBuilderForTable($tableName);
        $result = $queryBuilder->select('*')
            ->from($tableName)
            ->andWhere(
                $queryBuilder->expr()->eq(
                    $fieldName,
                    $queryBuilder->createNamedParameter($value)
                )
            )
            ->executeQuery()
            ->fetchAllAssociative();

        if (is_bool($result)) {
            return [];
        }

        return $result;
    }
}
