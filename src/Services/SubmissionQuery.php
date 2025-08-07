<?php
namespace Genusis\GenSuite\Services;

use Illuminate\Support\Facades\Http;

class SubmissionQuery
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function lookup(string $submissionId): array|string
    {
        $payload = [
            'DigitalMedia' => [
                'ClientID' => $this->config['client_id'],
                'Username' => $this->config['username'],
                'QUERY' => [
                    ['Media' => 'SMS', 'LookupID' => $submissionId]
                ]
            ]
        ];

        $json = json_encode($payload);
        $key = md5($json . $this->config['private_key']);

        $response = Http::post($this->config['base_url'] . "?Key={$key}", $json);
        return $response->json();
    }
}