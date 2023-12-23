<?php


use PHPUnit\Framework\TestCase;
use Document\DocumentTemplateType;
use Document\RecordType;
use ApprovalTests\CombinationApprovals;
use ApprovalTests\Approvals;

class DocumentRecordTest extends TestCase
{

    public function test_combination()
    {
        CombinationApprovals::verifyAllCombinations2(function ($documentType, $recordType) {
            $result = $this->simulateDocumentTemplateType($documentType, $recordType);
            $documentTypeString = $this->simulateGetDocumentType($result);
            $recordTypeString = $this->simulateGetRecordType($result);
            return $documentTypeString . " : " . $recordTypeString;
        }, ['AUTP', 'AUTM', 'DEERPP', 'DEERPM', 'SPEC', 'GLPP', 'GLPM'],
            ['IndividualPersonProspect', 'LegalEntityProspect', 'All']
        );
    }

    private function simulateDocumentTemplateType($documentType, $recordType)
    {
        return 'SimulationResult';
    }

    private function simulateGetDocumentType($result)
    {
        return 'SimulatedDocumentType';
    }

    private function simulateGetRecordType($result)
    {
        return 'SimulatedRecordType';
    }



//    public function test_verify_list()
//    {
//        $testCases = [
//            ['documentType' => 'DEER', 'recordType' => RecordType::INDIVIDUAL_PROSPECT()],
//            ['documentType' => 'DEER', 'recordType' => RecordType::LEGAL_PROSPECT()],
//            ['documentType' => 'AUTP', 'recordType' => RecordType::INDIVIDUAL_PROSPECT()],
//            ['documentType' => 'AUTM', 'recordType' => RecordType::LEGAL_PROSPECT()],
//            ['documentType' => 'SPEC', 'recordType' => RecordType::ALL()],
//            ['documentType' => 'GLPP', 'recordType' => RecordType::INDIVIDUAL_PROSPECT()],
//            ['documentType' => 'GLPM', 'recordType' => RecordType::LEGAL_PROSPECT()],
//        ];
//
//        foreach ($testCases as $testCase) {
//            $result = DocumentTemplateType::fromDocumentTypeAndRecordType($testCase['documentType'], $testCase['recordType']);
//            $list[] = serialize($result);
//        }
//
//        Approvals::verifyList($list);
//    }
}
