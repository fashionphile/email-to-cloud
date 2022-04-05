<?php

namespace App\Jobs\Mail\SalesForceMarketingCloud;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class EmailBuilder
{
    public $data;
    public $url;
    public $headers;

    public function sendEmail()
    {
        if ($message = $this->validate() || $this->shouldNotSend()) {
            return json_encode($message ?: 'Should not send email');
        }

        return $this->postRequest();
    }

    private function postRequest(): Response
    {
        $client = new Client();

        return $client->request('POST', $this->url, [
            'headers' => $this->headers,
            'body' => json_encode($this->data, true)
        ]);
    }

    private function validate(): array
    {
        $message = [];
        $requiredData = [
            'definitionKey' => 'definitionKey missing, this is a marketing cloud email key.',
            'email' => 'email missing, user\'s email that is going to get sent.',
            'user_id' => 'user_id missing, user id missing required for email service.',
        ];

        foreach ($requiredData as $key => $missingMessage) {
            if (!array_key_exists($key, $this->getData())) {
                $message[$key] = $missingMessage;
            }
        }
        if (!$this->url) {
            $message['url'] = 'Url Required for package to send email';
        }

        return $message;
    }

    public function to(string $email, int $userId): void
    {
        $this->data['email'] = $email;
        $this->data['user_id'] = $userId;
    }

    public function guzzleRequirement(array $guzzle): void
    {
        $this->setHeaders($guzzle['headers']);
        $this->setUrl($guzzle['url']);
    }

    public function buildEmailContent(array $emailSpecificData = []): void
    {
        $this->data['data'] = $emailSpecificData;
    }

    public function emailDefinitionKey(string $definitionKey)
    {
        $this->data['definitionKey'] = $definitionKey;
    }

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
    }
}
