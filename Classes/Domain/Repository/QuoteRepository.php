<?php
declare(strict_types=1);

namespace HauerHeinrich\HhExtQuotes\Domain\Repository;

use \TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use \TYPO3\CMS\Extbase\Persistence\Repository;
use \TYPO3\CMS\Extbase\Persistence\QueryInterface;
use \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;
use \TYPO3\CMS\Core\Utility\ClassNamingUtility;

/**
 * Class QuoteRepository
 *
 * @package HauerHeinrich\HhExtQuotes\Domain\Repository
 */
class QuoteRepository extends Repository {
    /**
     * @var array
     */
    protected $defaultOrderings = ['sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];

    public function __construct(
        private readonly ConnectionPool $connectionPool
    ) {
        $this->objectType = ClassNamingUtility::translateRepositoryNameToModelName($this->getRepositoryClassName());
    }

    public function initializeObject() {
        /** @var Typo3QuerySettings $querySettings */
        $querySettings = GeneralUtility::makeInstance(Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(FALSE);
        $querySettings->setRespectSysLanguage(TRUE);
        // $querySettings->setEnableFieldsToBeIgnored([]);
        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * findByPids
     *
     * @param  string      $pids - comma separeted pid´s
     * @param  string      $orderBy
     * @param  string      $sort
     * @return QueryResult
     */
    public function findByPids(string $pids, string $orderBy = 'uid', string $sort = 'ASC'): QueryResult {
        if($sort === 'ASC') {
            $sorting = QueryInterface::ORDER_ASCENDING;
        }
        if($sort === 'DESC') {
            $sorting = QueryInterface::ORDER_DESCENDING;
        }

        $query = $this->createQuery();
        $result = $query
            ->matching(
                $query->equals('pid', $pids),
            )
            ->setOrderings([
                $orderBy => $sorting
            ])
            ->execute();

        // $queryBuilder = $this->connectionPool->getQueryBuilderForTable('tx_hhextquotes_domain_model_quote');
        // $result = $queryBuilder
        //     ->select('*')
        //     ->from('tx_hhextquotes_domain_model_quote')
        //     ->where(
        //         $queryBuilder->expr()->in('pid',
        //             $queryBuilder->createNamedParameter(
        //                 GeneralUtility::intExplode(',', $pids, true),
        //                 ArrayParameterType::INTEGER
        //             )
        //         )
        //     )
        //     ->orderBy($orderBy, $sort)
        //     ->executeQuery()->fetchAllAssociative();

        return $result;
    }
}
