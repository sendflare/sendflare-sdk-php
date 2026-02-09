<?php

namespace Sendflare\SDK\Model;

/**
 * Get Contact list response entity
 */
class ListContactResp
{
    // CommonResponse fields
    public string $requestId = '';
    public int $code = 0;
    public bool $success = false;
    public string $message = '';
    public int $ts = 0;
    
    // PaginateResp fields
    public int $page = 0;
    public int $pageSize = 0;
    public int $totalCount = 0;
    
    // Data wrapper with list
    /** @var ContactListData|null */
    public ?ContactListData $data = null;
}

/**
 * Nested data structure containing the contact list
 */
class ContactListData
{
    /** @var array<string, string>[] */
    public array $list = [];
}

