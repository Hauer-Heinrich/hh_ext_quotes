<?php
declare(strict_types=1);

namespace HauerHeinrich\HhExtQuotes\Event;

use \TYPO3\CMS\Extbase\Mvc\Request;

final class StartQuoteListActionEvent {

    public function __construct(private Request $request, private array $settings, private array $assignedValues = []) {
    }

    public function getSettings(): array {
        return $this->settings;
    }

    public function setSettings(array $settings): void {
        $this->settings = $settings;
    }

    public function getAssignedValues(): array {
        return $this->assignedValues;
    }

    public function setAssignedValues(array $assignedValues): void {
        $this->assignedValues = $assignedValues;
    }
}
