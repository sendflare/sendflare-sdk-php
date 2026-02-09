<?php

namespace Sendflare\SDK;

use Sendflare\SDK\Model\DeleteContactReq;
use Sendflare\SDK\Model\DeleteContactResp;
use Sendflare\SDK\Model\ListContactReq;
use Sendflare\SDK\Model\ListContactResp;
use Sendflare\SDK\Model\SaveContactReq;
use Sendflare\SDK\Model\SaveContactResp;
use Sendflare\SDK\Model\SendEmailReq;
use Sendflare\SDK\Model\SendEmailResp;

/**
 * Sendflare SDK Client
 */
class SendflareClient
{
    private const BASE_URL = 'https://api.sendflare.com';
    private const REQUEST_TIMEOUT = 10;

    private string $token;

    /**
     * Create a new Sendflare client instance
     *
     * @param string $token API token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Send an email
     *
     * @param SendEmailReq $req Send email request
     * @return SendEmailResp Send email response
     * @throws \Exception
     */
    public function sendEmail(SendEmailReq $req): SendEmailResp
    {
        $path = '/v1/send';
        $data = $req->toArray();

        $response = $this->makeRequest('POST', $path, $data);
        return $this->mapToObject($response, SendEmailResp::class);
    }

    /**
     * Get contact list
     *
     * @param ListContactReq $req List contact request
     * @return ListContactResp List contact response
     * @throws \Exception
     */
    public function getContactList(ListContactReq $req): ListContactResp
    {
        $path = '/v1/contact';
        $params = [
            'appId' => $req->appId,
            'page' => $req->page,
            'pageSize' => $req->pageSize,
        ];

        $response = $this->makeRequest('GET', $path, null, $params);
        $result = $this->mapToObject($response, ListContactResp::class);
        // Handle nested data structure with pagination
        if (isset($response['data'])) {
            $contactListData = new Model\ContactListData();
            $contactListData->page = $response['data']['page'] ?? 0;
            $contactListData->pageSize = $response['data']['pageSize'] ?? 0;
            $contactListData->totalCount = $response['data']['totalCount'] ?? 0;
            if (isset($response['data']['list']) && is_array($response['data']['list'])) {
                $contactListData->list = $response['data']['list'];
            }
            $result->data = $contactListData;
        }
        
        return $result;
    }

    /**
     * Create or update contact
     *
     * @param SaveContactReq $req Save contact request
     * @return SaveContactResp Save contact response
     * @throws \Exception
     */
    public function saveContact(SaveContactReq $req): SaveContactResp
    {
        $path = '/v1/contact';
        $data = $req->toArray();

        $response = $this->makeRequest('POST', $path, $data);
        return $this->mapToObject($response, SaveContactResp::class);
    }

    /**
     * Delete a contact
     *
     * @param DeleteContactReq $req Delete contact request
     * @return DeleteContactResp Delete contact response
     * @throws \Exception
     */
    public function deleteContact(DeleteContactReq $req): DeleteContactResp
    {
        $path = '/v1/contact';
        $params = [
            'appId' => $req->appId,
            'emailAddress' => $req->emailAddress,
        ];

        $response = $this->makeRequest('DELETE', $path, null, $params);
        return $this->mapToObject($response, DeleteContactResp::class);
    }

    /**
     * Make HTTP request
     *
     * @param string $method HTTP method
     * @param string $path Request path
     * @param array|null $data Request body data
     * @param array|null $params Query parameters
     * @return array Response data
     * @throws \Exception
     */
    private function makeRequest(
        string $method,
        string $path,
        ?array $data = null,
        ?array $params = null
    ): array {
        $url = self::BASE_URL . $path;

        if ($params) {
            $url .= '?' . http_build_query($params);
        }

        $headers = [
            'Authorization: Bearer ' . $this->token,
            'Content-Type: application/json',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::REQUEST_TIMEOUT);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        switch (strtoupper($method)) {
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                if ($data) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                }
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
            case 'GET':
            default:
                // GET is default
                break;
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            throw new \Exception("HTTP request failed: " . $error);
        }

        if ($httpCode >= 400) {
            throw new \Exception("HTTP error: " . $httpCode);
        }

        $decoded = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("JSON decode error: " . json_last_error_msg());
        }

        return $decoded;
    }

    /**
     * Map array to object
     *
     * @param array $data Source data
     * @param string $className Target class name
     * @return object Mapped object
     */
    private function mapToObject(array $data, string $className): object
    {
        $object = new $className();

        foreach ($data as $key => $value) {
            if (property_exists($object, $key)) {
                $object->$key = $value;
            }
        }

        return $object;
    }
}

