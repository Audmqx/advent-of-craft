<?php

namespace Ci;

use Ci\Dependencies\Config;
use Ci\Dependencies\Emailer;
use Ci\Dependencies\Logger;
use Ci\Dependencies\Project;

class Pipeline {
    private $config;
    private $emailer;
    private $log;

    public function __construct(Config $config, Emailer $emailer, Logger $log) {
        $this->config = $config;
        $this->emailer = $emailer;
        $this->log = $log;
    }

    public function run(Project $project) {
        $testsPassed = false;
        $deploySuccessful = false;

        $testsPassed = $this->isTestsMissings($project, $testsPassed);

        $testsPassed = $this->isTestsPassed($project, $testsPassed);

        $testsPassed = $this->isTestsFailed($project, $testsPassed);

        $deploySuccessful = $this->IsDeploypmentPassed($testsPassed, $project, $deploySuccessful);

        $deploySuccessful = $this->isDeploymentFailed($testsPassed, $project, $deploySuccessful);

        if(!$this->config->sendEmailSummary()) {
            $this->log->info("Email disabled");
            return;
        }

        $this->log->info("Sending email");

        if (!$testsPassed){
            $this->emailer->send("Tests failed");
        }

        if (!$deploySuccessful) {
            $this->emailer->send("Deployment failed");
        }

        if ($deploySuccessful) {
            $this->emailer->send("Deployment completed successfully");
        }
    }

    /**
     * @param Project $project
     * @param bool $testsPassed
     * @return bool
     */
    public function isTestsMissings(Project $project, bool $testsPassed): bool
    {
        if (!$project->hasTests()) {
            $this->log->info("No tests");
            $testsPassed = true;
        }
        return $testsPassed;
    }

    /**
     * @param Project $project
     * @param bool $testsPassed
     * @return bool
     */
    public function isTestsPassed(Project $project, bool $testsPassed): bool
    {
        if ($project->hasTests() && "success" === $project->runTests()) {
            $this->log->info("Tests passed");
            $testsPassed = true;
        }
        return $testsPassed;
    }

    /**
     * @param Project $project
     * @param bool $testsPassed
     * @return bool
     */
    public function isTestsFailed(Project $project, bool $testsPassed): bool
    {
        if ($project->hasTests() && "success" != $project->runTests()) {
            $this->log->error("Tests failed");
            $testsPassed = false;
        }
        return $testsPassed;
    }

    /**
     * @param bool $testsPassed
     * @param Project $project
     * @param bool $deploySuccessful
     * @return bool
     */
    public function IsDeploypmentPassed(bool $testsPassed, Project $project, bool $deploySuccessful): bool
    {
        if ($testsPassed && "success" === $project->deploy()) {
            $this->log->info("Deployment successful");
            $deploySuccessful = true;
        }
        return $deploySuccessful;
    }

    /**
     * @param bool $testsPassed
     * @param Project $project
     * @param bool $deploySuccessful
     * @return bool
     */
    public function isDeploymentFailed(bool $testsPassed, Project $project, bool $deploySuccessful): bool
    {
        if ($testsPassed && "success" != $project->deploy()) {
            $this->log->error("Deployment failed");
            $deploySuccessful = false;
        }
        return $deploySuccessful;
    }
}
