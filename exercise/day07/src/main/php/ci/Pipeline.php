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

        if (!$project->hasTests()) {
            $this->log->info("No tests");
            $testsPassed = true;
        }

        if ($project->hasTests() && "success" === $project->runTests()) {
            $this->log->info("Tests passed");
            $testsPassed = true;
        }

        if ($project->hasTests() && "success" != $project->runTests()) {
            $this->log->error("Tests failed");
            $testsPassed = false;
        }


        if ($testsPassed && "success" === $project->deploy()) {
            $this->log->info("Deployment successful");
            $deploySuccessful = true;
        }

        if ($testsPassed && "success" != $project->deploy()) {
            $this->log->error("Deployment failed");
            $deploySuccessful = false;
        }

        if ($this->config->sendEmailSummary()) {
            $this->log->info("Sending email");
            if ($testsPassed) {
                if ($deploySuccessful) {
                    $this->emailer->send("Deployment completed successfully");
                } else {
                    $this->emailer->send("Deployment failed");
                }
            } else {
                $this->emailer->send("Tests failed");
            }
        } else {
            $this->log->info("Email disabled");
        }
    }
}
