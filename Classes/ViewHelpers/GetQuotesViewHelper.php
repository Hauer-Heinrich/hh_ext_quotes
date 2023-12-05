<?php
namespace HauerHeinrich\HhExtQuotes\ViewHelpers;

/***************************************************************
 * Copyright notice
 *
 * (c) 2020 Christian Hackl <hackl.chris@googlemail.com>
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 *
 * Example
 * <html xmlns:f="http://typo3.org/ns/TYPO3/CMS/Fluid/ViewHelpers"
 *   xmlns:hh="http://typo3.org/ns/VENDOR/NAMESPACE/ViewHelpers"
 *   data-namespace-typo3-fluid="true">
 *
 * Get FAL object of a content element e. g. from a EXT:gridelements child record
 * or if only attribute "id" is given then it looks for the id of the sys_file_reference table!
 * (in this case, multible ids are allowed as comma-separeted string e.g. "85,4")
 *
 */

use \Doctrine\DBAL\ArrayParameterType;
use \Doctrine\DBAL\ParameterType;
// use \TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use \TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;

class GetQuotesViewHelper extends AbstractViewHelper {

    public function __construct(
        private readonly ConnectionPool $connectionPool
    ) {
    }

    public function initializeArguments() {
        $this->registerArguments([
            ['id', 'string', 'uid(s)', true],
            ['dir', 'bool', 'if given uid(s) are the location of the quotes', false, false],
            ['as', 'string', '', false, 'quotes']
        ]);
    }

    /**
     * registerArguments
     *
     * @param Array $registers
     * @return void
     */
    function registerArguments(Array $registers) {
        foreach($registers as $registerKey => $registerVal) {
            $this->registerArgument(...$registerVal);
        }
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     *
     * @return void
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext) {
        $as = $arguments['as'];
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $result = [];
        $queryBuilder = $connectionPool->getQueryBuilderForTable('tx_hhextquotes_domain_model_quote');
        $selectedFields = ['title', 'author', 'author_info', 'author_name', 'cite', 'categories', 'description'];

        $queryBuilder
            ->select(...$selectedFields)
            ->from('tx_hhextquotes_domain_model_quote');

        if($arguments['dir']) {
            if(is_numeric($arguments['id'])) {
                $queryBuilder
                    ->where(
                        $queryBuilder->expr()->in('pid',
                            $queryBuilder->createNamedParameter(
                                $arguments['id'],
                                ParameterType::INTEGER
                            )
                        )
                    );
            } else {
                $queryBuilder
                    ->where(
                        $queryBuilder->expr()->in('pid',
                            $queryBuilder->createNamedParameter(
                                GeneralUtility::intExplode(',', $arguments['id'], true),
                                ArrayParameterType::INTEGER
                            )
                        )
                    );
            }
        } else {
            if(is_numeric($arguments['id'])) {
                $queryBuilder
                    ->where(
                        $queryBuilder->expr()->in('uid',
                            $queryBuilder->createNamedParameter(
                                $arguments['id'],
                                ParameterType::INTEGER
                            )
                        )
                    );
            } else {
                $queryBuilder
                    ->where(
                        $queryBuilder->expr()->in('uid',
                            $queryBuilder->createNamedParameter(
                                $arguments['id'],
                                ParameterType::INTEGER
                            )
                        )
                    );
            }
        }

        $result = $queryBuilder->executeQuery()->fetchAllAssociative();

        $templateVariableContainer = $renderingContext->getVariableProvider();
        $templateVariableContainer->add($as, $result);
        // $content = $renderChildrenClosure();
        // $templateVariableContainer->remove($as);
    }
}
