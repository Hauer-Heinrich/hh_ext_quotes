<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:hh_ext_quotes/Resources/Private/Language/locallang_db.xlf:tca.quote.ctrl.title',
        'label' => 'title',
        'label_alt' => 'description,author_info,author',
        'iconfile' => 'EXT:hh_ext_quotes/Resources/Public/Icons/Quote.svg',
        'searchFields' => 'title,author_info,author',
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
    ],

    'columns' => [
        'title' => [
            'label' => 'LLL:EXT:hh_ext_quotes/Resources/Private/Language/locallang_db.xlf:tca.quote.title',
            'config' => [
                'type' => 'input',
                'size' => '20',
                'eval' => 'trim'
            ],
        ],
        'description' => [
            'label' => 'LLL:EXT:hh_ext_quotes/Resources/Private/Language/locallang_db.xlf:tca.quote.description',
            'config' => [
                'type' => 'text',
                'eval' => 'trim'
            ],
        ],
        'author_info' => [
            'label' => 'LLL:EXT:hh_ext_quotes/Resources/Private/Language/locallang_db.xlf:tca.quote.author_info',
            'config' => [
                'type' => 'input',
                'size' => '20',
                'eval' => 'trim'
            ],
        ],
        'author' => [
            'label' => 'LLL:EXT:hh_ext_quotes/Resources/Private/Language/locallang_db.xlf:tca.quote.author',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tt_address',
                'items' => [
                    [
                        'label' => 'none',
                        'value' => 0,
                    ],
                ],
            ],
        ],
    ],

    'types' => [
        '0' => [
            'showitem' => '
                title,
                description,
                author,
                author_info
            '
        ],
    ],
];
