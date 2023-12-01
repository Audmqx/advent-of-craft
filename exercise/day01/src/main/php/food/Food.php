<?php

namespace Food;


use Ramsey\Uuid\UuidInterface;
use Carbon\Carbon;

class Food {

    public function __construct(
        private bool $approvedForConsumption,
        private ?UuidInterface $inspectorId,
        private ?Carbon $expirationDate
    ) {}

    public function isEdible(?Carbon $now): bool 
    {
        if (!$this->approvedForConsumption) {
            return false;
        }

        if (!$this->isValidInspector()) {
            return false;
        }

        if (!$this->isValidExpirationDate($now)) {
            return false;
        }

        return true;
    }

    private function isValidInspector(): bool
    {
        return $this->inspectorId instanceof UuidInterface ? true : false;
    }

    private function isValidExpirationDate($now): bool
    {
        if(!$now instanceof Carbon) {
            return false;
        }

        return $this->expirationDate->isAfter($now) ? true : false;
    }
}