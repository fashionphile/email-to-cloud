<?php

namespace FPemail\tests;

use FPemail\SendEmail;
use PHPUnit\Framework\TestCase;


class SendEmailTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->sendEmail = new SendEmail('APIEvent-362148a6-7be6-ea0d-4e7e-0abce155ca45', 'test');
        $this->data = [
            "definitionKey" => 'APIEvent-362148a6-7be6-ea0d-4e7e-0abce155ca45',
            "email" => "tanner.roberston@fashionphile.com",
            "user_id" => 605209,
            "data" => [
                "sku__c" => "BD595034",
                "discount_tier__c" => "70",
                "shopping_bag_count__c" => "3",
                "item_discount_amount__c" => "20",
                "original_product_price__c" => "1600",
            ],
        ];
    }

    /** @test
     * Set email and user id in class data object for post request
     */
    public function set_user_info_test()
    {
        $email = "tanner.roberston@fashionphile.com";
        $userId = 605209;
        $this->sendEmail->to($email, $userId);
        $classData = $this->sendEmail->data;

        $this->assertArrayHasKey('definitionKey', $classData);
        $this->assertArrayHasKey('email', $classData);
        $this->assertArrayHasKey('user_id', $classData);
    }

    /** @test
     * Email specific can be set and then gotten from global
     */
    public function set_data_test()
    {
        $this->sendEmail->setData($this->data['data']);
        $classData = $this->sendEmail->data;

        $this->assertArrayHasKey('definitionKey', $classData);
        $this->assertArrayHasKey('data', $classData);
    }

    /** @test
     * Check to see config is getting set dynamically and correctly based on environment
     */
    public function set_config_staging_test()
    {
        $this->sendEmail->config = [];
        $this->callMethod($this->sendEmail, 'setConfig', ['test']);

        $this->assertArrayHasKey('url', $this->sendEmail->config);
        $this->assertArrayHasKey('apiKey', $this->sendEmail->config);
    }


    /** @test
     * Check that validation is passable with correct data in place
     */
    public function validate_success_test()
    {
        $this->sendEmail->data = $this->data;
        $response = $this->callMethod($this->sendEmail, 'validate', []);

        $this->assertEmpty($response);
    }

    /** @test
     * Validation failure and array counting on messages sent back
     */
    public function validate_failure_test()
    {
        $this->sendEmail->data = [];
        $response = $this->callMethod($this->sendEmail, 'validate', []);

        $this->assertEquals(count($response), 3);
    }

    /** @test
     * check that data is set upon creation
     */
    public function get_data_test()
    {
        $response = $this->callMethod($this->sendEmail, 'getData', []);

        $this->assertNotEmpty($response);
    }

    /** @test
     * check that class is built correctly and can get x-api-key in header
     */
    public function get_headers_test()
    {
        $response = $this->callMethod($this->sendEmail, 'getHeaders', []);

        $this->assertArrayHasKey('x-api-key', $response);
    }

    /**
     * Use this for testing protected and private methods directly
     *
     * @param $object
     * @param $name
     * @param array $args
     * @return mixed
     * @throws \ReflectionException
     */
    protected function callMethod($object, $name, array $args)
    {
        $class = new \ReflectionClass($object);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $args);
    }
}
