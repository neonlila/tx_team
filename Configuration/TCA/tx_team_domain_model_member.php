<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Resource\FileType;

return [
    // ...
    'columns' => [
        // ...
        'photo' => [
            'exclude' => false,
            'label' => 'Profile Picture',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
                'allowed' => 'common-image-types',
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
                ],
                'overrideChildTca' => [
                    'types' => [
                        // TYPO3 v13/v14 Enum syntax (or simply '2')
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
    ],
];