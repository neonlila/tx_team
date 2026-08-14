<?php

declare(strict_types=1);

namespace Neon\TxTeam\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Backend\Attribute\AsController;
use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Neon\TxTeam\Domain\Repository\DepartmentRepository;
use Neon\TxTeam\Domain\Repository\MemberRepository;

#[AsController]
class AdminController extends ActionController
{
    public function __construct(
        private readonly MemberRepository $memberRepository,
        private readonly DepartmentRepository $departmentRepository,
        private readonly ModuleTemplateFactory $moduleTemplateFactory,
        private readonly UriBuilder $backendUriBuilder
    ) {}

    public function indexAction(): ResponseInterface
    {
        $moduleTemplate = $this->moduleTemplateFactory->create($this->request);
        $moduleTemplate->setTitle('Team Directory Admin');

        $this->view->assignMultiple([
            'memberCount' => $this->memberRepository->countAll(),
            'departmentCount' => $this->departmentRepository->countAll(),
            'recentMembers' => $this->memberRepository->findAll(),
        ]);

        $moduleTemplate->setContent($this->view->render());
        return $this->htmlResponse($moduleTemplate->renderContent());
    }

    public function membersAction(): ResponseInterface
    {
        $moduleTemplate = $this->moduleTemplateFactory->create($this->request);
        $moduleTemplate->setTitle('Manage Team Members');

        // Target page ID for record creation (defaults to current BE page selection)
        $id = (int)($this->request->getQueryParams()['id'] ?? 0);

        // Build native TYPO3 FormEngine edit & create links
        $newMemberUrl = (string)$this->backendUriBuilder->buildUriFromRoute('record_edit', [
            'edit' => [
                'tx_team_domain_model_member' => [
                    $id => 'new'
                ]
            ],
            'returnUrl' => (string)$this->request->getUri()
        ]);

        $this->view->assignMultiple([
            'members' => $this->memberRepository->findAll(),
            'newMemberUrl' => $newMemberUrl,
            'pageId' => $id
        ]);

        $moduleTemplate->setContent($this->view->render());
        return $this->htmlResponse($moduleTemplate->renderContent());
    }

    public function departmentsAction(): ResponseInterface
    {
        $moduleTemplate = $this->moduleTemplateFactory->create($this->request);
        $moduleTemplate->setTitle('Manage Departments');

        $id = (int)($this->request->getQueryParams()['id'] ?? 0);

        $newDepartmentUrl = (string)$this->backendUriBuilder->buildUriFromRoute('record_edit', [
            'edit' => [
                'tx_team_domain_model_department' => [
                    $id => 'new'
                ]
            ],
            'returnUrl' => (string)$this->request->getUri()
        ]);

        $this->view->assignMultiple([
            'departments' => $this->departmentRepository->findAll(),
            'newDepartmentUrl' => $newDepartmentUrl,
            'pageId' => $id
        ]);

        $moduleTemplate->setContent($this->view->render());
        return $this->htmlResponse($moduleTemplate->renderContent());
    }

    public function deleteMemberAction(int $memberUid): ResponseInterface
    {
        $member = $this->memberRepository->findByUid($memberUid);
        if ($member !== null) {
            $this->memberRepository->remove($member);
            $this->addFlashMessage('Member removed successfully.');
        }
        return $this->redirect('members');
    }
}