<?php
defined('TYPO3') || die();

use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

call_user_func(function() {
    $extensionKey = 'hh_ext_quotes';

    // make PageTsConfig selectable
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/AllPage.typoscript',
        'Quotes - Page TS'
    );

    // additional / extra config for: quotes
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/quotes-only.tsconfig',
        'Additional / extra config for: quotes'
    );
});
