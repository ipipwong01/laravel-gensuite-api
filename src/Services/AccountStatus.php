<?php
namespace Genusis\GenSuite\Services;

use Illuminate\Support\Facades\Http;

class AccountStatus
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function check(string $queryClientId = null): array|string
    {
        $queryClientId = $queryClientId ?: $this->config['client_id'];

        $payload = [
            'DigitalMedia' => [
                'ClientID' => $this->config['client_id'],
                'Username' => $this->config['username'],
                'ACCOUNT_STATUS' => [
                    'QueryClientID' => $queryClientId
                ]
            ]
        ];

        $json = json_encode($payload);
        $key = md5($json . $this->config['private_key']);

        $response = Http::post($this->config['base_url'] . "?Key={$key}", $json);
        return $response->json();
    }
}
