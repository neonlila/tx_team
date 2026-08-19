<?php

declare(strict_types=1);

namespace Neon\TxTeam\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

class Member extends AbstractEntity
{
    protected string $name = '';
    protected string $phone = '';
    protected string $email = '';
    protected string $position = '';
    protected string $bio = '';
    protected string $linkedin = '';
    protected ?Department $department = null;
    protected ?FileReference $photo = null;

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getBio(): string
    {
        return $this->bio;
    }

    public function getLinkedin(): string
    {
        return $this->linkedin;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function getPhoto(): ?FileReference
    {
        return $this->photo;
    }
}