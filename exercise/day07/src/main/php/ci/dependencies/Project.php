<?php

namespace Ci\Dependencies;

class Project {
    private $buildsSuccessfully;
    private $testStatus;

    private function __construct(bool $buildsSuccessfully, TestStatus $testStatus) {
        $this->buildsSuccessfully = $buildsSuccessfully;
        $this->testStatus = $testStatus;
    }

    public static function builder(): ProjectBuilder {
        return new ProjectBuilder();
    }

    public function hasTests(): bool {
        return $this->testStatus !== TestStatus::NO_TESTS;
    }

    public function runTests(): string {
        return $this->testStatus === TestStatus::PASSING_TESTS ? "success" : "failure";
    }

    public function deploy(): string {
        return $this->buildsSuccessfully ? "success" : "failure";
    }

    public static function create(bool $buildsSuccessfully, TestStatus $testStatus): Project {
        return new self($buildsSuccessfully, $testStatus);
    }

    public static function builderFromExistingProject(self $project): ProjectBuilder {
        return new ProjectBuilder($project);
    }

    public function test()
    {
        if (!$project->hasTests()) {
            $this->log->info("No tests");
            $testsPassed = true;
        }
    }


}

class ProjectBuilder {
    private $buildsSuccessfully;
    private $testStatus;

    public function __construct(Project $project = null) {
        if ($project !== null) {
            $this->buildsSuccessfully = $project->buildsSuccessfully;
            $this->testStatus = $project->testStatus;
        }
    }

    public function setTestStatus(TestStatus $testStatus): self {
        $this->testStatus = $testStatus;
        return $this;
    }

    public function setDeploysSuccessfully(bool $buildsSuccessfully): self {
        $this->buildsSuccessfully = $buildsSuccessfully;
        return $this;
    }

    public function build(): Project {
        return Project::create($this->buildsSuccessfully, $this->testStatus);
    }
}
