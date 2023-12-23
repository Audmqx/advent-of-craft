<?php

namespace Document;

use Document\RecordType;

class DocumentTemplateType {

    private $templates;
    private string $documentType;
    private RecordType $recordType;

    private function __construct(string $documentType, RecordType $recordType) {
        $this->documentType = $documentType;
        $this->recordType = $recordType;
    }

    public static function fromDocumentTypeAndRecordType($documentType, $recordType) {
        $instance = new self('', RecordType::ALL());

        foreach ($instance->getTemplates() as $template) {
                if (strcasecmp($template[0], $documentType) === 0
                    && ($template[1]->getValue() === $recordType->getValue() || $template[1]->getValue() === RecordType::ALL)) {
                    return new self($template[0], $template[1]);
                }
            }
            throw new \InvalidArgumentException("Invalid Document template type or record type");
    }

    private function getTemplates() {
        return [
            'DEERPP' => ['DEER', RecordType::INDIVIDUAL_PROSPECT()],
            'DEERPM' => ['DEER', RecordType::LEGAL_PROSPECT()],
            'AUTP'   => ['AUTP', RecordType::INDIVIDUAL_PROSPECT()],
            'AUTM'   => ['AUTM', RecordType::LEGAL_PROSPECT()],
            'SPEC'   => ['SPEC', RecordType::ALL()],
            'GLPP'   => ['GLPP', RecordType::INDIVIDUAL_PROSPECT()],
            'GLPM'   => ['GLPM', RecordType::LEGAL_PROSPECT()],
        ];
    }

    public function getRecordType() {
        return $this->recordType;
    }

    public function getDocumentType() {
        return $this->documentType;
    }
}
