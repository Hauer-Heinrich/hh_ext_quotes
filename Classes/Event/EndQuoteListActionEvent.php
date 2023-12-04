<?php

declare(strict_types=1);

namespace HauerHeinrich\HhExtQuotes\Event;

use \TYPO3\CMS\Extbase\Mvc\Request;
use \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
use \TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use \TYPO3\CMS\Core\Pagination\SimplePagination;

final class EndQuoteListActionEvent {

    public function __construct(
        private Request $request,
        private array $settings,
        private QueryResult $quotes,
        private QueryResultPaginator $paginator,
        private SimplePagination $pagination,
        private array $assignedValues = []
    ) {
    }

    public function getSettings(): array {
        return $this->settings;
    }

    public function setSettings(array $settings): void {
        $this->settings = $settings;
    }

    public function getQuotes(): QueryResult {
        return $this->quotes;
    }

    public function setQuotes(QueryResult $quotes): void {
        $this->quotes = $quotes;
    }

    public function getPaginator(): QueryResultPaginator {
        return $this->paginator;
    }

    public function setPaginator(QueryResultPaginator $paginator): void {
        $this->paginator = $paginator;
    }

    public function getPagination(): SimplePagination {
        return $this->pagination;
    }

    public function setPagination(SimplePagination $pagination): void {
        $this->pagination = $pagination;
    }

    public function getAssignedValues(): array {
        return $this->assignedValues;
    }

    public function setAssignedValues(array $assignedValues): void {
        $this->assignedValues = $assignedValues;
    }
}
