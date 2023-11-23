<?php
declare(strict_types=1);

namespace HauerHeinrich\HhExtQuotes\Controller;

use \Psr\Http\Message\ResponseInterface;
use \TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use \TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use \HauerHeinrich\HhExtQuotes\Domain\Repository\QuoteRepository;

/**
 * Class QuoteController
 *
 * @package HauerHeinrich\HhExtQuotes\Controller
 */
class QuoteController extends ActionController {

    public function __construct(private QuoteRepository $quoteRepository) {
    }

    /**
     * List Action
     *
     * @return void
     */
    public function listAction(): ResponseInterface {
        $quotes = $this->quoteRepository->findAll();
        $this->view->assign('quotes', $quotes);

        return $this->htmlResponse();
    }

}
