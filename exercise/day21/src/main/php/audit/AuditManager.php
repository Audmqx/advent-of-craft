<?php

namespace Audit;

use Carbon\Carbon;
use Audit\FileSystem;

class AuditManager {
    const NEW_FILE = 'New file created';
    const FILE_UPDATED = 'File updated';

    private int $maxEntriesPerFile;
    private string $directoryName;
    private FileSystem $fileSystem;

    public function __construct(int $maxEntriesPerFile, string $directoryName, FileSystem $fileSystem) {
        $this->maxEntriesPerFile = $maxEntriesPerFile;
        $this->directoryName = $directoryName;
        $this->fileSystem = $fileSystem;
    }

    public function addRecord(string $visitorName, Carbon $timeOfVisit): array {
        $filePaths = $this->readDirectory();
        $sortedFiles = $this->sortByIndex($filePaths);
        $newRecord = $this->prepareNewVisitorRecord($visitorName, $timeOfVisit);

        if ($this->filesDoesntExists($sortedFiles)) {
            $newFile = $this->createNewfile("audit_1.txt");
            $this->writeRecords($newFile, $newRecord);
            return $this->generateAuditReportForRecord(self::NEW_FILE, $newFile, $newRecord);
        }

        $currentFileIndex = count($sortedFiles) - 1;
        $currentFilePath = $sortedFiles[$currentFileIndex];
        $lines = $this->readFile($currentFilePath);
       
        if ($this->fileCanAccommodateNewEntry($lines)) {
            $records = $this->formatRecordsForWriting($lines, $newRecord);
            $this->writeRecords($currentFilePath, $records);
            return $this->generateAuditReportForRecord(self::FILE_UPDATED, $currentFilePath, $records);
        } 

        $newFileName = "audit_" . ($currentFileIndex + 2) . ".txt";
        $this->writeRecords($this->createNewfile($newFileName), $newRecord);
        return $this->generateAuditReportForRecord(self::NEW_FILE, $newFileName, $newRecord);
    }

    public function readFile(string $filePath): array
    {
        return $this->fileSystem->readAllLines($filePath);
    }

    public function generateAuditReportForRecord(string $operation, string $file, string $content): array
    {
        return [
            'operation' => $operation,
            'file' => $file,
            'content' => $content
        ];
    }

    private function readDirectory(): array
    {
        return $this->fileSystem->getFiles($this->directoryName);
    }

    private function prepareNewVisitorRecord(string $visitorName, Carbon $timeOfVisit): string
    {
        return  $visitorName . ";" . $timeOfVisit->format("Y-m-d H:i:s");
    }

    private function filesDoesntExists(array $files): bool
    {
        return count($files) === 0;
    }

    private function writeRecords(string $file, string $content)
    {
        $this->fileSystem->writeAllText($file, $content);
    }

    private function createNewfile(string $fileName): string
    {
        return $this->directoryName . "/" . $fileName;
    }

    private function fileCanAccommodateNewEntry(array $lines): string
    {
        return count($lines) < $this->maxEntriesPerFile;
    }

    private function formatRecordsForWriting(array $lines, string $newLine): string
    {
        $lines[] = $newLine;
        return implode(PHP_EOL, $lines);
    }

    private function sortByIndex(array $filePaths): array {
        sort($filePaths);
        return $filePaths;
    }
}
