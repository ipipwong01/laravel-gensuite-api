<?php
namespace Genusis\GenSuite\Services;

use Illuminate\Support\Facades\Http;

class SmsSender
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    protected function send(array $payload): bool
    {
        $json = json_encode($payload);
        $key = md5($json . $this->config['private_key']);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($this->config['base_url'] . "?Key={$key}", $json);

        $data = $response->json();

        return isset($data['DigitalMedia'][0]['Result']) && $data['DigitalMedia'][0]['Result'] === 'success';
    }

    public function sendTac(string $msisdn, string $tac): bool
    {
        $payload = [
            'DigitalMedia' => [
                'ClientID' => $this->config['client_id'],
                'Username' => $this->config['username'],
                'SEND' => [[
                    'Media' => 'SMS',
                    'SubmissionID' => uniqid('tac_'),
                    'Message' => "RM0 Your TAC code is: {$tac}",
                    'MessageType' => 'S',
                    'Destination' => [[ 'MSISDN' => $msisdn ]]
                ]]
            ]
        ];

        return $this->send($payload);
    }

    public function sendBulk(array $messages): bool
    {
        $payload = [
            'DigitalMedia' => [
                'ClientID' => $this->config['client_id'],
                'Username' => $this->config['username'],
                'SEND' => $messages
            ]
        ];

        return $this->send($payload);
    }

    public function sendIod(array $entries): bool
    {
        $payload = [
            'DigitalMedia' => [
                'ClientID' => $this->config['client_id'],
                'Username' => $this->config['username'],
                'SEND' => [[
                    'Media' => 'SMS',
                    'Service' => 'IOD',
                    'SubmissionID' => uniqid('iod_'),
                    'Destination' => $entries
                ]]
            ]
        ];

        return $this->send($payload);
    }
}
