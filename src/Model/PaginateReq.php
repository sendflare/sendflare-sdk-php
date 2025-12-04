<?php

namespace Sendflare\SDK\Model;

/**
 * Pagination request entity
 */
class PaginateReq
{
    public int $page;
    public int $pageSize;

    public function __construct(int $page = 1, int $pageSize = 10)
    {
        $this->page = $page;
        $this->pageSize = $pageSize;
    }
}

