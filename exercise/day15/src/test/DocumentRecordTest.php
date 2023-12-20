<?php


use PHPUnit\Framework\TestCase;
use Document\DocumentTemplateType;
use Document\RecordType;

class DocumentRecordTest extends TestCase
{   
 

    public function test_output_of_fromDocumentTypeAndRecordType()
    {
        $documentTemplateType = DocumentTemplateType::fromDocumentTypeAndRecordType('DEER', RecordType::INDIVIDUAL_PROSPECT());

        $this->assertInstanceOf(DocumentTemplateType::class, $documentTemplateType);
        $this->assertSame('DEER', $documentTemplateType->getDocumentType());
        $this->assertSame(RecordType::INDIVIDUAL_PROSPECT, $documentTemplateType->getRecordType()->getValue());
    }

    public function test_save_snapshot()
    {
        $testCases = [
            ['documentType' => 'DEER', 'recordType' => RecordType::INDIVIDUAL_PROSPECT()],
            ['documentType' => 'DEER', 'recordType' => RecordType::LEGAL_PROSPECT()],
            ['documentType' => 'AUTP', 'recordType' => RecordType::INDIVIDUAL_PROSPECT()],
            ['documentType' => 'AUTM', 'recordType' => RecordType::LEGAL_PROSPECT()],
            ['documentType' => 'SPEC', 'recordType' => RecordType::ALL()],
            ['documentType' => 'GLPP', 'recordType' => RecordType::INDIVIDUAL_PROSPECT()],
            ['documentType' => 'GLPM', 'recordType' => RecordType::LEGAL_PROSPECT()],
        ];

        $approvalFilePath = 'fromDocumentTypeAndRecordType.approved.txt';

        if (file_exists($approvalFilePath)) {
            return;
        }

        foreach ($testCases as $testCase) {
            $result = DocumentTemplateType::fromDocumentTypeAndRecordType($testCase['documentType'], $testCase['recordType']);
            $approvedResults[] = serialize($result);
        }

        file_put_contents($approvalFilePath, serialize($approvedResults));
    }

    public function test_fromDocumentTypeAndRecordType() 
    {
        $approvalFilePath = 'fromDocumentTypeAndRecordType.approved.txt';
        $approvedResult = unserialize(file_get_contents($approvalFilePath));

        //Assertions and approval comparison
    }
}
