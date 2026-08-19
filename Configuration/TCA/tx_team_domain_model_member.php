<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Resource\FileType;

return [
    'ctrl' => [
        'title' => 'Team Member',
        'label' => 'name',
        'label_alt' => 'position',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'sortby' => 'sorting',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'name, position, bio',
        'iconfile' => 'EXT:core/Resources/Public/Icons/T3Icons/svgs/avatar/avatar-default.svg',
    ],
    'types' => [
        '0' => [
            'showitem' => '
                --div--;General, hidden, name, phone, email, position, department, linkedin, photo,
                --div--;Biography, bio
            ',
        ],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        'label' => '',
                        'invertStateDisplay' => true,
                    ],
                ],
            ],
        ],
        'name' => [
            'exclude' => false,
            'label' => 'Full Name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'phone' => [
            'exclude' => false,
            'label' => 'Phone number',
            'config' => [
                'type' => 'input',
                'size' => 35,
                'eval' => 'trim',
                'required' => false,
            ],
        ],
        'email' => [
            'exclude' => false,
            'label' => 'Email address',
            'config' => [
                'type' => 'input',
                'size' => 40,
                'eval' => 'trim',
                'required' => false,
            ],
        ],
        'position' => [
            'exclude' => false,
            'label' => 'Job Position / Role',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'linkedin' => [
            'exclude' => false,
            'label' => 'LinkedIn Profile URL',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
            ],
        ],
        'department' => [
            'exclude' => false,
            'label' => 'Department',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_team_domain_model_department',
                'items' => [
                    ['label' => '-- Select Department --', 'value' => 0],
                ],
                'default' => 0,
            ],
        ],
        'photo' => [
            'exclude' => false,
            'label' => 'Profile Picture',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
                'allowed' => 'common-image-types',
                'overrideChildTca' => [
                    'types' => [
                        FileType::IMAGE->value => [
                            'showitem' => 'crop, --palette--;;filePalette',
                        ],
                    ],
                    'columns' => [
                        'crop' => [
                            'config' => [
                                'cropVariants' => [
                                    'default' => [
                                        'title' => 'Square Avatar',
                                        'allowedAspectRatios' => [
                                            '1:1' => [
                                                'title' => '1:1 Square',
                                                'value' => 1.0,
                                            ],
                                        ],
                                        'selectedRatio' => '1:1',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'bio' => [
            'exclude' => false,
            'label' => 'Biography',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'cols' => 40,
                'rows' => 15,
            ],
        ],
    ],
];