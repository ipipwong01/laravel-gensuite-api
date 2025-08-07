<?php

namespace Genusis\GenSuite;

use Genusis\GenSuite\Services\SmsSender;
use Genusis\GenSuite\Services\AccountStatus;
use Genusis\GenSuite\Services\SubmissionQuery;
use Genusis\GenSuite\Services\ScheduleManager;

class GenSuiteService
{
    protected array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config ?: config('gensuite');
    }

    public function sendTac(string $msisdn, string $tac): bool
    {
        return (new SmsSender($this->config))->sendTac($msisdn, $tac);
    }

    public function sendBulkSms(array $messages): bool
    {
        return (new SmsSender($this->config))->sendBulk($messages);
    }

    public function sendIodSms(array $entries): bool
    {
        return (new SmsSender($this->config))->sendIod($entries);
    }

    public function checkAccountStatus(string $queryClientId = null): array|string
    {
        return (new AccountStatus($this->config))->check($queryClientId);
    }

    public function querySubmissionStatus(string $submissionId): array|string
    {
        return (new SubmissionQuery($this->config))->lookup($submissionId);
    }

    public function cancelScheduledSms(string $resultId): bool
    {
        return (new ScheduleManager($this->config))->cancel($resultId);
    }
}