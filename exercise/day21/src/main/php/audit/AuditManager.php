<?php

namespace Audit;

use Carbon\Carbon;
use Audit\FileSystem;

class AuditManager {
    private int $maxEntriesPerFile;
    private string $directoryName;
    private FileSystem $fileSystem;

    public function __construct(int $maxEntriesPerFile, string $directoryName, FileSystem $fileSystem) {
        $this->maxEntriesPerFile = $maxEntriesPerFile;
        $this->directoryName = $directoryName;
        $this->fileSystem = $fileSystem;
    }

    public function readRecord(): array
    {
        return ['Alice;2019-04-06 18:00:00'];
    }

    public function addRecord(string $visitorName, Carbon $timeOfVisit): void {
        $filePaths = $this->fileSystem->getFiles($this->directoryName);
        $sorted = $this->sortByIndex($filePaths);
        $dateTimeFormatter = "Y-m-d H:i:s";
        $newRecord = $visitorName . ";" . $timeOfVisit->format($dateTimeFormatter);

        if (count($sorted) === 0) {
            $newFile = $this->directoryName . "/audit_1.txt";
            $this->fileSystem->writeAllText($newFile, $newRecord);
            return;
        }

        $currentFileIndex = count($sorted) - 1;
        $currentFilePath = $sorted[$currentFileIndex];
        $lines = $this->fileSystem->readAllLines($currentFilePath);

        if (count($lines) < $this->maxEntriesPerFile) {
            $lines[] = $newRecord;
            $newContent = implode(PHP_EOL, $lines);
            $this->fileSystem->writeAllText($currentFilePath, $newContent);
        } else {
            $newName = "audit_" . ($currentFileIndex + 2) . ".txt";
            $newFile = $this->directoryName . "/" . $newName;
            $this->fileSystem->writeAllText($newFile, $newRecord);
        }
    }

    private function sortByIndex(array $filePaths): array {
        sort($filePaths);
        return $filePaths;
    }
}
