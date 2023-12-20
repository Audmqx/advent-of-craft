<?php

namespace Document;

use Exception;

class DocumentTemplateType {
    const DEERPP = "DEER";
    const DEERPM = "DEER";
    const AUTP = "AUTP";
    const AUTM = "AUTM";
    const SPEC = "SPEC";
    const GLPP = "GLPP";
    const GLPM = "GLPM";

    private $documentType;
    private $recordType;

    public function __construct($documentType, $recordType) {
        $this->documentType = $documentType;
        $this->recordType = $recordType;
    }

    public function fromDocumentTypeAndRecordType($documentType, $recordType) {
        foreach (get_class_vars(get_class($this)) as $constant => $value) {
            if (strcasecmp($value, $documentType) === 0) {
                return new DocumentTemplateType($value, $recordType);
            }
        }
        throw new Exception("Invalid Document template type");
    }

    public function getRecordType() {
        return $this->recordType;
    }

    public function getDocumentType() {
        return $this->documentType;
    }
}
?>