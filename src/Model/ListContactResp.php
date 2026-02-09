<?php

namespace Sendflare\SDK\Model;

/**
 * Get Contact list response entity
 */
class ListContactResp extends CommonResponse
{
    // Data wrapper with pagination and list
    /** @var ContactListData */
    public mixed $data;

    // Getter method
    public function getData(): ContactListData
    {
        if (!$this->data instanceof ContactListData) {
            // if array, convert to object
            if (is_array($this->data)) {
                $this->data = ContactListData::fromArray($this->data);
            } else {
                throw new \InvalidArgumentException('data must be instance of ContactListData');
            }
        }
        return $this->data;
    }
}

/**
 * Nested data structure containing pagination and contact list
 */
class ContactListData
{
    // PaginateResp fields
    public int $page = 0;
    public int $pageSize = 0;
    public int $totalCount = 0;
    
    // Contact list
    /** @var array<string, string>[] */
    public array $list = [];
}

