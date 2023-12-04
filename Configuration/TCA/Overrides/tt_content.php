<?php
defined('TYPO3') or die;

use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$extensionKey = 'hh_ext_quotes';
$extensionName = strtolower(GeneralUtility::underscoredToUpperCamelCase($extensionKey));

$pluginName = 'ListView';
$pluginSignature = $extensionName . '_' . strtolower($pluginName);

ExtensionUtility::registerPlugin(
    $extensionKey,
    $pluginName,
    'LLL:EXT:'.$extensionKey.'/Resources/Private/Language/locallang_db.xlf:extbase_title'
);

// Adds the content element to the "Type" dropdown
ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:EXT:'.$extensionKey.'/Resources/Private/Language/locallang_db.xlf:extbase_title',
        'value' => $pluginSignature,
        'icon' => '',
        'group' => 'ext-quotes',
        'description' => ''
    ],
    'textmedia',
    'after'
);

ExtensionManagementUtility::addTCAcolumns('tt_content',
    [
        'quotes' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:'.$extensionKey.'/Resources/Private/Language/locallang_db.xlf:ce.tca.quotes',
            'description' => '',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tx_hhextquotes_domain_model_quote',
                'size' => 5,
                'minitems' => 0,
                'autoSizeMax' => 10,
                'wizards' => [
                    'suggest' => [
                        'type' => 'suggest'
                    ],
                ],
                'suggestOptions' => [
                    'default' => [
                        'addWhere' => 'AND tx_hhextquotes_domain_model_quote.sys_language_uid IN (-1,0)'
                    ]
                ]
            ],
        ],
        'quotes_records' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:'.$extensionKey.'/Resources/Private/Language/locallang_db.xlf:ce.tca.quotes_records',
            'description' => '',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'pages',
                'size' => 3,
                'minitems' => 0,
                'wizards' => [
                    'suggest' => [
                        'type' => 'suggest'
                    ],
                ],
            ],
        ],
        'sort_by' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:'.$extensionKey.'/Resources/Private/Language/locallang_db.xlf:ce.tca.sort_by',
            'description' => '',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [ 'Default', 'uid' ],
                    [ 'Title', 'title' ],
                    [ 'crdate', 'crdate' ],
                    [ 'tstamp', 'tstamp' ],
                    [ 'author info', 'author_info' ],
                    [ 'author name', 'author_name' ],
                    [ '(address) author first name', 'author.first_name' ],
                    [ '(address) author last name', 'author.first_name' ],
                    [ '(address) author slug', 'author.slug' ],
                ],
            ],
        ],
        'sort_order' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:'.$extensionKey.'/Resources/Private/Language/locallang_db.xlf:ce.tca.sort_order',
            'description' => '',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [ 'ascending', 'ASC' ],
                    [ 'descending', 'DESC' ]
                ],
            ],
        ],
        'items_per_page' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:'.$extensionKey.'/Resources/Private/Language/locallang_db.xlf:ce.tca.items_per_page',
            'description' => '',
            'config' => [
                'type' => 'number',
                'range' => [
                    'lower' => 1,
                ],
            ]
        ],
        'pagination' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:'.$extensionKey.'/Resources/Private/Language/locallang_db.xlf:ce.tca.pagination',
            'description' => '',
            'config' => [
                'type' => 'check',
                'items' => [
                    [
                        'label' => 'Pagination',
                    ],
                ],
                'default' => 1,
            ],
        ],
    ]
);

$GLOBALS['TCA']['tt_content']['palettes']['quote_sort']['showitem'] = 'sort_by, sort_order';
$GLOBALS['TCA']['tt_content']['palettes']['quote_pagination']['showitem'] = 'pagination, items_per_page';

$GLOBALS['TCA']['tt_content']['types'][$pluginSignature] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
            assets;LLL:EXT:'.$extensionKey.'/Resources/Private/Language/locallang_db.xlf:ce.tca.assets,
            quotes,
            --palette--;;quote_sort,
            --palette--;;quote_pagination,
            quotes_records,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
            --palette--;;frames,
            --palette--;;appearanceLinks,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;;access,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
            categories,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
            rowDescription,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
    '
];
