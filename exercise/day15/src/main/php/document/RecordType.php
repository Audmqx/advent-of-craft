<?php

namespace Document;

class RecordType {
    const INDIVIDUAL_PROSPECT = 'IndividualPersonProspect';
    const LEGAL_PROSPECT = 'LegalEntityProspect';
    const ALL = 'All';

    private string $value;

    private function __construct(string $value) {
        $this->value = $value;
    }

    public function getValue(): string {
        return $this->value;
    }

    public static function INDIVIDUAL_PROSPECT(): RecordType {
        return new self(self::INDIVIDUAL_PROSPECT);
    }

    public static function LEGAL_PROSPECT(): RecordType {
        return new self(self::LEGAL_PROSPECT);
    }

    public static function ALL(): RecordType {
        return new self(self::ALL);
    }
}
