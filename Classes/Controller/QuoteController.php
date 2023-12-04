<?php
declare(strict_types=1);

namespace HauerHeinrich\HhExtQuotes\Controller;

use \Psr\Http\Message\ResponseInterface;
use \TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use \TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use \TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use \TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use \TYPO3\CMS\Core\Pagination\ArrayPaginator;
use \TYPO3\CMS\Core\Pagination\PaginatorInterface;
use \TYPO3\CMS\Core\Pagination\SimplePagination;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \HauerHeinrich\HhExtQuotes\Domain\Repository\QuoteRepository;
use \HauerHeinrich\HhExtQuotes\Event\StartQuoteListActionEvent;
use \HauerHeinrich\HhExtQuotes\Event\EndQuoteListActionEvent;

/**
 * Class QuoteController
 *
 * @package HauerHeinrich\HhExtQuotes\Controller
 */
class QuoteController extends ActionController {

    /**
     * ContentElementData
     *
     * @var array
     */
    protected $data = null;

    public function __construct(private QuoteRepository $quoteRepository) {
    }

    public function initializeView(): void {
        $this->data = $this->configurationManager->getContentObject()->data;

        if(isset($this->data['assets'])) {
            $fileRepository = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Resource\FileRepository::class);
            $this->data['assets'] = $fileRepository->findByRelation('tt_content', 'assets', $this->data['uid']);
        }

        if(isset($this->data['image'])) {
            $fileRepository = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Resource\FileRepository::class);
            $this->data['image'] = $fileRepository->findByRelation('tt_content', 'image', $this->data['uid']);
        }

        if(isset($this->data['media'])) {
            $fileRepository = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Resource\FileRepository::class);
            $this->data['media'] = $fileRepository->findByRelation('tt_content', 'media', $this->data['uid']);
        }
    }

    /**
     * List Action
     *
     * @return void
     */
    public function listAction(): ResponseInterface {
        $quotes = [];

        /** @var StartQuoteListActionEvent $event */
        $eventBefore = $this->eventDispatcher->dispatch(
            new StartQuoteListActionEvent($this->request, $this->data)
        );
        $this->data = $eventBefore->getSettings();

        $itemsPerPage  = isset($this->data['items_per_page']) ? \intval($this->data['items_per_page']) : 100;

        if(empty($this->data['quotes'])) {
            $sortBy = isset($this->data['sort_by']) ? $this->data['sort_by'] : 'uid';
            $sortOrder = isset($this->data['sort_order']) ? $this->data['sort_order'] : 'ASC';

            if(empty($this->data['quotes_records'])) {
                $quotes = $this->quoteRepository->findAll();
            } else {
                $quotes = $this->quoteRepository->findByPids(
                    pids: $this->data['quotes_records'],
                    orderBy: $sortBy,
                    sort: $sortOrder
                );
            }
        } else {
            $selectedQuotesString = $this->data['quotes'];
            $selectedquotesArray = \explode(',', $selectedQuotesString);
            if(!empty($selectedquotesArray)) {
                foreach ($selectedquotesArray as $quoteId) {
                    $quotes[] = $this->quoteRepository->findByUid((int)$quoteId);
                }
            }
        }

        $paginator = null;
        $pagination = null;
        if (isset($this->data['pagination']) && $this->data['pagination'] == true) {
            $paginator = $this->getPaginator($quotes, $itemsPerPage);
            $pagination = new SimplePagination($paginator);
        }

        /** @var EndQuoteListActionEvent $event */
        $eventAfter = $this->eventDispatcher->dispatch(
            new EndQuoteListActionEvent($this->request, $this->data, $quotes, $paginator, $pagination)
        );
        $this->data = $eventAfter->getSettings();
        $quotes = $eventAfter->getQuotes();
        $paginator = $eventAfter->getPaginator();
        $pagination = $eventAfter->getPagination();

        $this->view->assignMultiple([
            'data' => $this->data,
            'quotes' => $quotes,
            'paginator' => $paginator,
            'pagination' => $pagination,
        ]);

        return $this->htmlResponse();
    }

    /**
     * @param QueryResultInterface|array $items
     * @param int $itemsPerPage
     * @return ArrayPaginator|QueryResultPaginator
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     */
    protected function getPaginator($items, int $itemsPerPage = 100): PaginatorInterface {
        $currentPage = $this->request->hasArgument('currentPage') ? (int)$this->request->getArgument('currentPage') : 1;

        if (is_array($items)) {
            $paginator = new ArrayPaginator($items, $currentPage, $itemsPerPage);
        } elseif ($items instanceof QueryResultInterface) {
            $paginator = new QueryResultPaginator($items, $currentPage, $itemsPerPage);
        } else {
            throw new \RuntimeException(sprintf('Only array and query result interface allowed for pagination, given "%s"', get_class($items)), 1611168593);
        }

        return $paginator;
    }
}
