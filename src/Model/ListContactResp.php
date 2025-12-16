<?php

namespace Sendflare\SDK\Model;

/**
 * Get Contact list response entity
 */
class ListContactResp extends PaginateResp
{
    /** @var array<string, string>[] */
    public array $list = [];
}

