<?php

use Audit\AuditManager;
use Audit\FileSystem;
use Carbon\Carbon;

test('Audit should add a new visitor to a new file when end of last file is reached', function () {
    // Arrange
    $fileSystemMock = Mockery::mock(FileSystem::class);

    $fileSystemMock->shouldReceive('getFiles')
        ->with('audits')
        ->andReturn([
            'audits/audit_2.txt',
            'audits/audit_1.txt',
        ]);
        
    $fileSystemMock->shouldReceive('readAllLines')
        ->with('audits/audit_2.txt')
        ->andReturn([
            'Peter;2019-04-06 16:30:00',
            'Jane;2019-04-06 16:40:00',
            'Jack;2019-04-06 17:00:00',
        ]);

    $fileSystemMock->shouldReceive('writeAllText')
    ->with('audits/audit_3.txt', 'Alice;2019-04-06 18:00:00')
    ->once();
    
    // Act
    $sut = new AuditManager(3, 'audits', $fileSystemMock);
    $report = $sut->addRecord('Alice', Carbon::createFromFormat('Y-m-d H:i:s', '2019-04-06 18:00:00'));

    // Assert
    expect($report)
        ->toHaveKey('operation', 'New file created' )
        ->toHaveKey('file', 'audit_3.txt')
        ->toHaveKey('content', 'Alice;2019-04-06 18:00:00');
});
