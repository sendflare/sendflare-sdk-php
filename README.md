# sendflare-sdk-php

The SDK for sendflare service written in PHP.

## Requirements

- PHP >= 8.0
- cURL extension
- JSON extension

## Installation

Install via Composer:

```bash
composer require sendflare/sendflare-sdk-php
```

## Quick Start

```php
<?php

require_once 'vendor/autoload.php';

use Sendflare\SDK\SendflareClient;
use Sendflare\SDK\Model\SendEmailReq;

$client = new SendflareClient('your-api-token');

$req = new SendEmailReq(
    'test@example.com',
    'to@example.com',
    'Hello',
    'Test email'
);

try {
    $response = $client->sendEmail($req);
    echo "Email sent successfully!\n";
    print_r($response);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
```

## Usage Examples

### Send Email

```php
use Sendflare\SDK\SendflareClient;
use Sendflare\SDK\Model\SendEmailReq;

$client = new SendflareClient('your-api-token');

$req = new SendEmailReq(
    'sender@example.com',
    'recipient@example.com',
    'Subject Here',
    'Email body content'
);

$response = $client->sendEmail($req);
if ($response->success) {
    echo "Email sent successfully!";
}
```

### Get Contact List

```php
use Sendflare\SDK\SendflareClient;
use Sendflare\SDK\Model\ListContactReq;

$client = new SendflareClient('your-api-token');

$req = new ListContactReq('your-app-id', 1, 10);

$response = $client->getContactList($req);
echo "Total contacts: " . $response->totalCount . "\n";

foreach ($response->data as $contact) {
    echo "Email: " . $contact->emailAddress . "\n";
}
```

### Save Contact

```php
use Sendflare\SDK\SendflareClient;
use Sendflare\SDK\Model\SaveContactReq;

$client = new SendflareClient('your-api-token');

$req = new SaveContactReq('your-app-id', 'john@example.com', [
    'firstName' => 'John',
    'lastName' => 'Doe',
    'company' => 'Acme Corp'
]);

$response = $client->saveContact($req);
if ($response->success) {
    echo "Contact saved successfully!";
}
```

### Delete Contact

```php
use Sendflare\SDK\SendflareClient;
use Sendflare\SDK\Model\DeleteContactReq;

$client = new SendflareClient('your-api-token');

$req = new DeleteContactReq('john@example.com', 'your-app-id');

$response = $client->deleteContact($req);
if ($response->success) {
    echo "Contact deleted successfully!";
}
```

## API Reference

### SendflareClient

#### Constructor

```php
public function __construct(string $token)
```

Create a new Sendflare client instance.

**Parameters:**
- `$token` - Your Sendflare API token

#### Methods

##### sendEmail

```php
public function sendEmail(SendEmailReq $req): SendEmailResp
```

Send an email.

**Parameters:**
- `$req` - Send email request object
  - `from` - Sender email address
  - `to` - Recipient email address
  - `subject` - Email subject
  - `body` - Email body content

**Returns:** `SendEmailResp`

**Throws:** `Exception`

##### getContactList

```php
public function getContactList(ListContactReq $req): ListContactResp
```

Get contact list with pagination.

**Parameters:**
- `$req` - List contact request object
  - `appId` - Application ID
  - `page` - Page number (default: 1)
  - `pageSize` - Items per page (default: 10)

**Returns:** `ListContactResp`

**Throws:** `Exception`

##### saveContact

```php
public function saveContact(SaveContactReq $req): SaveContactResp
```

Create or update a contact.

**Parameters:**
- `$req` - Save contact request object
  - `appId` - Application ID
  - `emailAddress` - Contact email address
  - `data` - Contact data (optional array)

**Returns:** `SaveContactResp`

**Throws:** `Exception`

##### deleteContact

```php
public function deleteContact(DeleteContactReq $req): DeleteContactResp
```

Delete a contact.

**Parameters:**
- `$req` - Delete contact request object
  - `emailAddress` - Contact email address
  - `appId` - Application ID

**Returns:** `DeleteContactResp`

**Throws:** `Exception`

## Model Classes

### Request Models

- `SendEmailReq` - Send email request
- `ListContactReq` - Get contact list request
- `SaveContactReq` - Save contact request
- `DeleteContactReq` - Delete contact request
- `PaginateReq` - Pagination request (base class)

### Response Models

- `SendEmailResp` - Send email response
- `ListContactResp` - Get contact list response
- `SaveContactResp` - Save contact response
- `DeleteContactResp` - Delete contact response
- `CommonResponse` - Common response (base class)
- `PaginateResp` - Pagination response (base class)
- `ContactItem` - Contact information

## Testing

Run tests with PHPUnit:

```bash
composer install
composer test
```

Or directly with PHPUnit:

```bash
./vendor/bin/phpunit
```

## Error Handling

All API methods may throw exceptions. It's recommended to wrap calls in try-catch blocks:

```php
try {
    $response = $client->sendEmail($req);
    // Handle success
} catch (Exception $e) {
    // Handle error
    error_log("Sendflare API error: " . $e->getMessage());
}
```

## Documentation

For more information, visit: [https://docs.sendflare.com](https://docs.sendflare.com)

## License

[MIT](./LICENSE)

