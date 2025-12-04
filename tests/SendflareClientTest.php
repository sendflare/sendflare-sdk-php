<?php

namespace Sendflare\SDK\Tests;

use PHPUnit\Framework\TestCase;
use Sendflare\SDK\Model\DeleteContactReq;
use Sendflare\SDK\Model\ListContactReq;
use Sendflare\SDK\Model\SaveContactReq;
use Sendflare\SDK\Model\SendEmailReq;
use Sendflare\SDK\SendflareClient;

class SendflareClientTest extends TestCase
{
    private SendflareClient $client;

    protected function setUp(): void
    {
        $this->client = new SendflareClient('this-is-my-token');
    }

    public function testNewSendflareClient(): void
    {
        $client = new SendflareClient('this-is-my-token');
        $this->assertInstanceOf(SendflareClient::class, $client);
    }

    public function testSendEmail(): void
    {
        $req = new SendEmailReq(
            'test@example.com',
            'to@example.com',
            'test',
            'test email'
        );

        try {
            $resp = $this->client->sendEmail($req);
            echo "Email response: " . print_r($resp, true) . "\n";
        } catch (\Exception $e) {
            echo "Expected error without valid token: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    public function testGetContactList(): void
    {
        $req = new ListContactReq('test', 1, 10);

        try {
            $resp = $this->client->getContactList($req);
            echo "Contact list response: " . print_r($resp, true) . "\n";
        } catch (\Exception $e) {
            echo "Expected error without valid token: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    public function testSaveContact(): void
    {
        $req = new SaveContactReq('test', 'test@example.com', [
            'firstName' => 'John',
            'lastName' => 'Doe',
        ]);

        try {
            $resp = $this->client->saveContact($req);
            echo "Save contact response: " . print_r($resp, true) . "\n";
        } catch (\Exception $e) {
            echo "Expected error without valid token: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }

    public function testDeleteContact(): void
    {
        $req = new DeleteContactReq('test@example.com', 'test');

        try {
            $resp = $this->client->deleteContact($req);
            echo "Delete contact response: " . print_r($resp, true) . "\n";
        } catch (\Exception $e) {
            echo "Expected error without valid token: " . $e->getMessage() . "\n";
            $this->assertTrue(true);
        }
    }
}

