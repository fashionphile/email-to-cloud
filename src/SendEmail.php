<?php

namespace FPemail;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class SendEmail
{
    public array $config;
    public array $data;

    /**
     * @throws Exception
     */
    public function __construct(
        string $definitionKey,
        string $environment = 'test'
    ) {
        $this->data['definitionKey'] = $definitionKey;
        $this->setConfig($environment);
    }

    /**
     * Send request to sfmc lambda triggering email
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception
     */
    public function send(): Response
    {
        if ($message = $this->validate()) {
            throw new Exception(json_encode($message));
        }

        return $this->postRequest();
    }

    /**
     * Set the user email and id in data object
     *
     * @param  string  $email
     * @param  int  $userId
     * @return void
     */
    public function to(string $email, int $userId): void
    {
        $this->data['email'] = $email;
        $this->data['user_id'] = $userId;
    }

    /**
     * Set the email specific data if needed
     *
     * @param  array  $emailSpecificData
     * @return void
     */
    public function setData(array $emailSpecificData = []): void
    {
        $this->data['data'] = $emailSpecificData;
    }

    /**
     * Set config based on found or given environment
     *
     * @param  string  $environment
     * @return void
     *
     * @throws Exception
     */
    private function setConfig(string $environment): void
    {
        $connectConfig = include(__DIR__.'/config/connectData.php');

        switch ($environment) {
            case 'production':
                $this->config = $connectConfig['production'];
                break;
            case 'staging':
                $this->config = $connectConfig['staging'];
                break;
            case 'test':
            case 'local':
            case 'development':
                $this->config = $connectConfig['development'];
                break;
            default:
                throw new Exception('unable to find environment type'.json_encode($this->data));
        }

    }

    /**
     * Validate minimum requirements for eamils and send message if failure
     *
     * @return array
     * @throws Exception
     */
    private function validate(): array
    {
        $message = [];
        $required = [
            'definitionKey' => 'definitionKey missing, this is a marketing cloud email key.',
            'email' => 'email missing, user\'s email that is going to get sent.',
            'user_id' => 'user_id missing, user id missing required for email service.',
        ];

        foreach ($required as $key => $missingMessage) {
            if (!array_key_exists($key, $this->getData())) {
                $message[$key] = $missingMessage;
            }
        }

        return $message;
    }

    /**
     * Send Built request to trigger email
     *
     * @return Response
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function postRequest(): Response
    {
        $client = new Client();

        return $client->request('POST', $this->config['url'], [
            'headers' => $this->getHeaders(),
            'body' => json_encode($this->getData(), true)
        ]);
    }

    /**
     * Set the email specific data if needed
     *
     * @return void
     * @throws Exception
     */
    private function getHeaders(): array
    {
        if (!isset($this->config) && !isset($this->config['apiKey'])) {
            throw new Exception('No apiKey was found in current config');
        }

        return [
            'x-api-key' => $this->config['apiKey'],
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * Get current global data
     *
     * @return void
     * @throws Exception
     */
    private function getData(): array
    {
        if (!isset($this->data)) {
            throw new Exception('No Data found cannot build email request');
        }

        return $this->data;
    }
}
