<?php

namespace Sendflare\SDK\Model;

/**
 * Get Contact list request entity
 */
class ListContactReq extends PaginateReq
{
    public string $appId;

    public function __construct(string $appId, int $page = 1, int $pageSize = 10)
    {
        parent::__construct($page, $pageSize);
        $this->appId = $appId;
    }
}

