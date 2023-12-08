<?php

namespace Ci;

use Ci\Dependencies\Config;
use Ci\Dependencies\Emailer;
use Ci\Dependencies\Project;
use Ci\Dependencies\TestStatus;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use CiTest\CapturingLogger;
use Ci\Pipeline;

class PipelineTest extends TestCase {
    private Config|MockObject $config;
    private CapturingLogger $log;
    private Emailer|MockObject $emailer;
    private Pipeline $pipeline;

    protected function setUp(): void {
        $this->config = $this->createMock(Config::class);
        $this->log = new CapturingLogger();
        $this->emailer = $this->createMock(Emailer::class);
        $this->pipeline = new Pipeline($this->config, $this->emailer, $this->log);
    }

    public function test_project_with_tests_that_deploys_successfully_with_email_notification(): void {
        $this->config->expects($this->once())->method('sendEmailSummary')->willReturn(true);

        $project = Project::builder()
            ->setTestStatus(TestStatus::PASSING_TESTS)
            ->setDeploysSuccessfully(true)
            ->build();

        $this->pipeline->run($project);

        $this->assertEquals(
            [
                "INFO: Tests passed",
                "INFO: Deployment successful",
                "INFO: Sending email",
            ],
            $this->log->getLoggedLines()
        );

       // $this->emailer->expects($this->once())->method('send')->with($this->equalTo("Deployment completed successfully"));
    }

    public function test_Project_With_Tests_That_Deploys_Successfully_Without_Email_Notification(): void {
        $this->config->expects($this->once())->method('sendEmailSummary')->willReturn(false);

        $project = Project::builder()
            ->setTestStatus(TestStatus::PASSING_TESTS)
            ->setDeploysSuccessfully(true)
            ->build();

        $this->pipeline->run($project);

        $this->assertEquals(
            [
                "INFO: Tests passed",
                "INFO: Deployment successful",
                "INFO: Email disabled",
            ],
            $this->log->getLoggedLines()
        );

        $this->emailer->expects($this->never())->method('send');
    }

    public function testProjectWithoutTestsThatDeploysSuccessfullyWithEmailNotification(): void {
        $this->config->expects($this->once())->method('sendEmailSummary')->willReturn(true);

        $project = Project::builder()
            ->setTestStatus(TestStatus::NO_TESTS)
            ->setDeploysSuccessfully(true)
            ->build();

        $this->pipeline->run($project);

        $this->assertEquals(
            [
                "INFO: No tests",
                "INFO: Deployment successful",
                "INFO: Sending email",
            ],
            $this->log->getLoggedLines()
        );

        //$this->emailer->expects($this->once())->method('send')->with("Deployment completed successfully");
    }

    public function testProjectWithoutTestsThatDeploysSuccessfullyWithoutEmailNotification(): void {
        $this->config->expects($this->once())->method('sendEmailSummary')->willReturn(false);

        $project = Project::builder()
            ->setTestStatus(TestStatus::NO_TESTS)
            ->setDeploysSuccessfully(true)
            ->build();

        $this->pipeline->run($project);

        $this->assertEquals(
            [
                "INFO: No tests",
                "INFO: Deployment successful",
                "INFO: Email disabled",
            ],
            $this->log->getLoggedLines()
        );

        $this->emailer->expects($this->never())->method('send');
    }

//    public function testProjectWithTestsThatFailWithEmailNotification(): void {
//        $this->config->expects($this->once())->method('sendEmailSummary')->willReturn(true);
//
//        $project = Project::builder()
//            ->setTestStatus(TestStatus::FAILING_TESTS)
//            ->build();
//
//        $this->pipeline->run($project);
//
//        $this->assertEquals(
//            [
//                "ERROR: Tests failed",
//                "INFO: Sending email",
//            ],
//            $this->log->getLoggedLines()
//        );
//
//        $this->emailer->expects($this->once())->method('send')->with("Tests failed");
//    }

//    public function testProjectWithTestsThatFailWithoutEmailNotification(): void {
//        $this->config->expects($this->once())->method('sendEmailSummary')->willReturn(false);
//
//        $project = Project::builder()
//            ->setTestStatus(TestStatus::FAILING_TESTS)
//            ->build();
//
//        $this->pipeline->run($project);
//
//        $this->assertEquals(
//            [
//                "ERROR: Tests failed",
//                "INFO: Email disabled",
//            ],
//            $this->log->getLoggedLines()
//        );
//
//        $this->emailer->expects($this->never())->method('send');
//    }

    public function testProjectWithTestsAndFailingBuildWithEmailNotification(): void {
        $this->config->expects($this->once())->method('sendEmailSummary')->willReturn(true);

        $project = Project::builder()
            ->setTestStatus(TestStatus::PASSING_TESTS)
            ->setDeploysSuccessfully(false)
            ->build();

        $this->pipeline->run($project);

        $this->assertEquals(
            [
                "INFO: Tests passed",
                "ERROR: Deployment failed",
                "INFO: Sending email",
            ],
            $this->log->getLoggedLines()
        );

        //$this->emailer->expects($this->once())->method('send')->with("Deployment failed");
    }

    public function testProjectWithTestsAndFailingBuildWithoutEmailNotification(): void {
        $this->config->expects($this->once())->method('sendEmailSummary')->willReturn(false);

        $project = Project::builder()
            ->setTestStatus(TestStatus::PASSING_TESTS)
            ->setDeploysSuccessfully(false)
            ->build();

        $this->pipeline->run($project);

        $this->assertEquals(
            [
                "INFO: Tests passed",
                "ERROR: Deployment failed",
                "INFO: Email disabled",
            ],
            $this->log->getLoggedLines()
        );

        $this->emailer->expects($this->never())->method('send');
    }

    public function testProjectWithoutTestsAndFailingBuildWithEmailNotification(): void {
        $this->config->expects($this->once())->method('sendEmailSummary')->willReturn(true);

        $project = Project::builder()
            ->setTestStatus(TestStatus::NO_TESTS)
            ->setDeploysSuccessfully(false)
            ->build();

        $this->pipeline->run($project);

        $this->assertEquals(
            [
                "INFO: No tests",
                "ERROR: Deployment failed",
                "INFO: Sending email",
            ],
            $this->log->getLoggedLines()
        );

        //$this->emailer->expects($this->once())->method('send')->with("Deployment failed");
    }

    public function testProjectWithoutTestsAndFailingBuildWithoutEmailNotification(): void {
        $this->config->expects($this->once())->method('sendEmailSummary')->willReturn(false);

        $project = Project::builder()
            ->setTestStatus(TestStatus::NO_TESTS)
            ->setDeploysSuccessfully(false)
            ->build();

        $this->pipeline->run($project);

        $this->assertEquals(
            [
                "INFO: No tests",
                "ERROR: Deployment failed",
                "INFO: Email disabled",
            ],
            $this->log->getLoggedLines()
        );

        $this->emailer->expects($this->never())->method('send');
    }
}
