<?php
defined('TYPO3') or die;

(function() {
    $extensionKey = 'hh_ext_quotes';

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        $extensionKey,
        'ListView',
        [
            \HauerHeinrich\HhExtQuotes\Controller\QuoteController::class => 'list,show'
        ],
        [
            \HauerHeinrich\HhExtQuotes\Controller\QuoteController::class => ''
        ],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );
})();
