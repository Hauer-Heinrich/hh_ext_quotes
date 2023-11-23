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

# $GLOBALS['TCA']['tt_content']['types']['list']['previewRenderer'][$pluginSignature] = \HauerHeinrich\HhExtQuotes\FormEngine\TtAddressPreviewRenderer::class;
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'select_key,pages,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:'.$extensionKey.'/Configuration/FlexForms/'.$pluginSignature.'.xml'
);

// Adds the content element to the "Type" dropdown
ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:'.$extensionKey.'/Resources/Private/Language/locallang_db.xlf:extbase_title',
        $pluginSignature,
        // 'your-icon-identifier',
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
    ]
);

$GLOBALS['TCA']['tt_content']['types'][$pluginSignature] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;headers,
            assets;LLL:EXT:'.$extensionKey.'/Resources/Private/Language/locallang_db.xlf:ce.tca.assets,
            quotes,
            quotes_records,
    '
];
