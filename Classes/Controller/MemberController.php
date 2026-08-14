<?php

declare(strict_types=1);

namespace Neon\TxTeam\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Neon\TxTeam\Domain\Repository\MemberRepository;
use Neon\TxTeam\Domain\Repository\DepartmentRepository;
use Psr\Http\Message\ResponseInterface;

class MemberController extends ActionController
{
    public function __construct(
        private readonly MemberRepository $memberRepository,
        private readonly DepartmentRepository $departmentRepository
    ) {}

    public function listAction(int $department = 0): ResponseInterface
    {
        if ($department > 0) {
            $members = $this->memberRepository->findByDepartmentUid($department);
        } else {
            $members = $this->memberRepository->findAll();
        }

        $departments = $this->departmentRepository->findAll();

        $this->view->assignMultiple([
            'members' => $members,
            'departments' => $departments,
            'currentDepartment' => $department,
        ]);

        return $this->htmlResponse();
    }
}