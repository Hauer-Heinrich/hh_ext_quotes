<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "hh_ext_quotes".
 *
 * Auto generated 16-11-2023 14:28
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF['hh_ext_quotes'] = [
    'title' => 'Hauer-Heinrich - Quotes',
    'description' => 'Hauer-Heinrich - quotes.',
    'category' => 'distribution',
    'version' => '0.1.5',
    'state' => 'beta',
    'uploadfolder' => false,
    'clearcacheonload' => false,
    'author' => 'Christian Hackl',
    'author_email' => 'chackl@hauer-heinrich.de',
    'author_company' => 'www.hauer-heinrich.de',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-12.4.99',
            'tt_address' => '>=8.0.0',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'HauerHeinrich\\HhExtQuotes\\' => 'Classes',
        ],
    ],
];
