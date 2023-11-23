<?php
declare(strict_types=1);

namespace HauerHeinrich\HhExtQuotes\Domain\Model;

use \TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use \TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use \FriendsOfTYPO3\TtAddress\Domain\Model\Address;

class Quote extends AbstractEntity {

    /**
     * The name of the product
     *
     * @var string
     **/
    protected $title = '';

    /**
     * The description of the product
     *
     * @var string
     **/
    protected $description = '';

    /**
     * The authorInfo of the product
     *
     * @var string
     **/
    protected $authorInfo = '';

    /**
     * The author of the product
     *
     * @var Address
     **/
    protected $author = null;

    /**
     * Product constructor.
     *
     * @param string $title
     * @param string $description
     * @param int $quantity
     */
    public function __construct(string $title = '', string $description = '', string $authorInfo = '', Address $author = null)
    {
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setAuthorInfo($authorInfo);
        $this->setAuthor($author);
    }

    /**
     * Sets the title of the product
     *
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Gets the title of the product
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the description of the product
     *
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Gets the description of the product
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets the authorInfo of the product
     *
     * @param string $authorInfo
     */
    public function setAuthorInfo(string $authorInfo): void
    {
        $this->authorInfo = $authorInfo;
    }

    /**
     * Gets the authorInfo of the product
     *
     * @return string
     */
    public function getAuthorInfo(): string
    {
        return $this->authorInfo;
    }

    /**
     * Sets the author of the product
     *
     * @param Address $author
     */
    public function setAuthor(Address $author): void
    {
        $this->author = $author;
    }

    /**
     * Gets the author of the product
     *
     * @return Address
     */
    public function getAuthor(): Address
    {
        return $this->author;
    }
}
