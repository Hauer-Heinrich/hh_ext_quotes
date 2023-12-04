<?php
declare(strict_types=1);

namespace HauerHeinrich\HhExtQuotes\Domain\Model;

// use \TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use \TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use \FriendsOfTYPO3\TtAddress\Domain\Model\Address;

class Quote extends AbstractEntity {

    /**
     * @var \DateTime
     */
    protected $crdate;

    /**
     * @var \DateTime
     */
    protected $tstamp;

    /**
     * @var \DateTime
     */
    protected $starttime;

    /**
     * @var \DateTime
     */
    protected $endtime;

    /**
     * @var bool
     */
    protected $hidden;

    /**
     * @var bool
     */
    protected $deleted;

    /**
     * @var int
     */
    protected $cruserId;

    /**
     * @var int
     */
    protected $sorting;

    /**
     * The name of the quote
     *
     * @var string
     **/
    protected $title = '';

    /**
     * The description of the quote
     *
     * @var string
     **/
    protected $description = '';

    /**
     * The authorInfo of the quote
     *
     * @var string
     **/
    protected $authorInfo = '';

    /**
     * The authorName of the quote
     *
     * @var string
     **/
    protected $authorName = '';

    /**
     * The author of the quote
     *
     * @var Address
     **/
    protected $author = null;

    /**
     * The cite of the quote
     *
     * @var string
     */
    protected $cite = '';

    /**
     * quote constructor.
     *
     * @param string $title
     * @param string $description
     * @param int $quantity
     */
    public function __construct(string $title = '', string $description = '', string $authorInfo = '', string $authorName = '', Address $author = null)
    {
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setAuthorInfo($authorInfo);
        $this->setAuthorName($authorName);
        $this->setAuthor($author);
    }

    /**
     * Sets the title of the quote
     *
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Gets the title of the quote
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the description of the quote
     *
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Gets the description of the quote
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets the authorInfo of the quote
     *
     * @param string $authorInfo
     */
    public function setAuthorInfo(string $authorInfo): void
    {
        $this->authorInfo = $authorInfo;
    }

    /**
     * Gets the authorInfo of the quote
     *
     * @return string
     */
    public function getAuthorInfo(): string
    {
        return $this->authorInfo;
    }

    /**
     * Sets the authorName of the quote
     *
     * @param string $authorName
     */
    public function setAuthorName(string $authorName): void
    {
        $this->authorName = $authorName;
    }

    /**
     * Gets the authorName of the quote
     *
     * @return string
     */
    public function getAuthorName(): string
    {
        return $this->authorName;
    }

    /**
     * Sets the author of the quote
     *
     * @param Address $author
     */
    public function setAuthor(Address $author): void
    {
        $this->author = $author;
    }

    /**
     * Gets the author of the quote
     *
     * @return ?Address
     */
    public function getAuthor(): ?Address
    {
        return $this->author;
    }

    public function getAddressAuthorName(): string {
        $authorName = '';
        $author = $this->getAuthor();
        if(!empty($author)) {
            $authorName = $author->getTitle()
                . ' ' . $author->getFirstName()
                . ' ' . $author->getMiddleName()
                . ' ' . $author->getLastName();
        }

        return trim($authorName);
    }

    /**
     * Sets the cite of the quote
     *
     * @param string $cite
     */
    public function setCite(string $cite): void
    {
        $this->cite = $cite;
    }

    /**
     * Gets the cite of the quote
     *
     * @return string
     */
    public function getCite(): string
    {
        return $this->cite;
    }

    /**
     * Get creation date
     *
     * @return \DateTime
     */
    public function getCrdate(): \DateTime
    {
        return $this->crdate;
    }

    /**
     * Set creation date
     *
     * @param \DateTime $crdate
     */
    public function setCrdate(\DateTime $crdate): void
    {
        $this->crdate = $crdate;
    }

    /**
     * Get year of crdate
     *
     * @return int
     */
    public function getYearOfCrdate()
    {
        return $this->getCrdate()->format('Y');
    }

    /**
     * Get month of crdate
     *
     * @return int
     */
    public function getMonthOfCrdate(): int
    {
        return (int)$this->getCrdate()->format('m');
    }

    /**
     * Get day of crdate
     *
     * @return int
     */
    public function getDayOfCrdate(): int
    {
        return (int)$this->crdate->format('d');
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTstamp(): \DateTime
    {
        return $this->tstamp;
    }

    /**
     * Set time stamp
     *
     * @param \DateTime $tstamp time stamp
     */
    public function setTstamp(\DateTime $tstamp): void
    {
        $this->tstamp = $tstamp;
    }

    /**
     * Get year of tstamp
     *
     * @return int
     */
    public function getYearOfTstamp(): int
    {
        return (int)$this->getTstamp()->format('Y');
    }

    /**
     * Get month of tstamp
    *
    * @return int
    */
    public function getMonthOfTstamp(): int
    {
        return (int)$this->getTstamp()->format('m');
    }

    /**
     * Get day of tstamp
    *
    * @return int
    */
    public function getDayOfTimestamp(): int
    {
        return (int)$this->tstamp->format('d');
    }

    /**
     * Get id of creator user
    *
    * @return int
    */
    public function getCruserId(): int
    {
        return $this->cruserId;
    }

    /**
     * Set cruser id
    *
    * @param int $cruserId id of creator user
    */
    public function setCruserId($cruserId)
    {
        $this->cruserId = $cruserId;
    }

    /**
     * Get hidden flag
    *
    * @return bool
    */
    public function getHidden(): bool
    {
        return (bool)$this->hidden;
    }

    /**
     * Set hidden flag
     *
     * @param int $hidden hidden flag
     */
    public function setHidden(int $hidden): void
    {
        $this->hidden = $hidden;
    }

    /**
     * Get deleted flag
     *
     * @return bool
     */
    public function getDeleted(): bool
    {
        return (bool)$this->deleted;
    }

    /**
     * Set deleted flag
     *
     * @param int $deleted deleted flag
     */
    public function setDeleted(int $deleted): void
    {
        $this->deleted = $deleted;
    }

    /**
     * Get start time
     *
     * @return \DateTime
     */
    public function getStarttime(): \DateTime
    {
        return $this->starttime;
    }

    /**
     * Set start time
     *
     * @param int $starttime start time
     */
    public function setStarttime($starttime): void
    {
        $this->starttime = $starttime;
    }

    /**
     * Get year of starttime
     *
     * @return int
     */
    public function getYearOfStarttime(): int
    {
        if ($this->getStarttime()) {
            return (int)$this->getStarttime()->format('Y');
        }

        return 0;
    }

    /**
     * Get month of starttime
     *
     * @return int
     */
    public function getMonthOfStarttime(): int
    {
        if ($this->getStarttime()) {
            return (int)$this->getStarttime()->format('m');
        }

        return 0;
    }

    /**
     * Get day of starttime
     *
     * @return int
     */
    public function getDayOfStarttime(): int
    {
        if ($this->starttime) {
            return (int)$this->starttime->format('d');
        }
    }

    /**
     * Get endtime
     *
     * @return \DateTime
     */
    public function getEndtime(): \DateTime
    {
        return $this->endtime;
    }

    /**
     * Set end time
     *
     * @param int $endtime end time
     */
    public function setEndtime($endtime): void
    {
        $this->endtime = $endtime;
    }

     /**
      * Get year of endtime
      *
      * @return int
      */
    public function getYearOfEndtime(): int
    {
        if ($this->getEndtime()) {
            return (int)$this->getEndtime()->format('Y');
        }

        return 0;
    }

    /**
     * Get month of endtime
     *
     * @return int
     */
    public function getMonthOfEndtime(): int
    {
        if ($this->getEndtime()) {
            return (int)$this->getEndtime()->format('m');
        }

        return 0;
    }

    /**
     * Get day of endtime
     *
     * @return int
     */
    public function getDayOfEndtime(): int
    {
        if ($this->endtime) {
            return (int)$this->endtime->format('d');
        }

        return 0;
    }

    /**
     * Get sorting
     *
     * @return int
     */
    public function getSorting(): int
    {
        return $this->sorting;
    }

    /**
     * Set sorting
     *
     * @param int $sorting sorting
     */
    public function setSorting(int $sorting): void
    {
        $this->sorting = $sorting;
    }
}
