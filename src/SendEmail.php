<?php

namespace FPemail;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class SendEmail
{
    public $data;
    public $url;
    public $headers;

    public function send()
    {
        if ($message = $this->validate()) {
            return json_encode($message);
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
            'definitionKey' => 'DefinitionKey missing, this is a marketing cloud email key.',
            'email' => 'Email missing, user\'s email that is going to get sent.',
        ];

        foreach ($requiredData as $key => $missingMessage) {
            if (!array_key_exists($key, $this->data)) {
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

    public function toEmail(string $email): void
    {
        $this->data['email'] = $email;
    }

    public function toUserId(int $userId): void
    {
        $this->data['user_id'] = $userId;
    }

    public function guzzleRequirement(array $guzzle): void
    {
        $this->setHeaders($guzzle['headers']);
        $this->setUrl($guzzle['url']);
    }

    public function buildEmailContent(object $emailSpecificData = null): void
    {
        $emailSpecificData = $emailSpecificData ?? (object)[];

        $this->data['data'] = $emailSpecificData;
    }

    public function emailDefinitionKey(string $definitionKey): void
    {
        $this->data['definitionKey'] = $definitionKey;
    }

    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}
