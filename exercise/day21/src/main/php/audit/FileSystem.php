<?php

namespace Audit;

interface FileSystem {
    public function getFiles(string $directoryName): array;

    public function writeAllText(string $filePath, string $content): void;

    public function readAllLines(string $filePath): array;
}
