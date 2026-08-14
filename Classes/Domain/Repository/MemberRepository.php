<?php

declare(strict_types=1);

namespace Neon\TxTeam\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

class MemberRepository extends Repository
{
    protected $defaultOrderings = [
        'sorting' => QueryInterface::ORDER_ASCENDING,
    ];

    public function findByDepartmentUid(int $departmentUid): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('department.uid', $departmentUid)
        );
        return $query->execute();
    }
}